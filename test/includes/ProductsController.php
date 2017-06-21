<?php

namespace Waredesk\Tests;

use GuzzleHttp\Psr7\Response;
use Waredesk\Models\Product;

class ProductsController
{
    /**
     * @var BaseTest
     */
    protected $baseTest;

    public function __construct(BaseTest $baseTest)
    {
        $this->baseTest = $baseTest;
    }

    private function response()
    {
        return file_get_contents(__DIR__ . '/../files/products/product.json');
    }

    private function responseArray()
    {
        return json_encode([json_decode($this->response(), true)]);
    }

    public function getDefaultProduct(): Product
    {
        $this->baseTest->mock->append(new Response(200, [], $this->responseArray()));
        $product = $this->baseTest->waredesk->products->findOneBy(['name' => 'Amazing T-Shirt']);

        if ($product && !$this->validateDefaultProduct($product)) {
            $this->deleteDefaultProduct($product);
            $product = null;
        }
        if (!$product) {
            $product = $this->createDefaultProduct();
        }
        return $product;
    }

    private function createDefaultProduct(): Product
    {
        $product = new Product();
        $product->setName('Amazing T-Shirt');
        $product->setDescription('This T-Shirt will cover your belly');
        $product->getCategories()->add($this->baseTest->categoriesController->getMenCategory());
        $product->getCategories()->add($this->baseTest->categoriesController->getUnderwearCategory());

        $variant = new Product\Variant();
        $variant->setName('X-Large');
        $product->getVariants()->add($variant);

        $itemAttribute = new Product\Variant\Item\Attribute();
        $itemAttribute->setName('Serial Number');
        $itemAttribute->setValue('default value');
        $variant->getItemsAttributes()->add($itemAttribute);

        $this->baseTest->mock->append(new Response(200, [], $this->response()));
        return $this->baseTest->waredesk->products->create($product);
    }

    private function deleteDefaultProduct(Product $product)
    {
        $this->baseTest->mock->append(new Response(200, [], 'true'));
        $this->baseTest->waredesk->products->delete($product);
    }

    private function validateDefaultProduct(Product $product = null): bool
    {
        if (count($product->getCategories()) !== 2) {
            return false;
        } else {
            if ($product->getCategories()->offsetGet(0)->getName() !== 'Men') {
                return false;
            } elseif ($product->getCategories()->offsetGet(1)->getName() !== 'Underwear') {
                return false;
            }
        }
        if ($product->getImages() !== null) {
            return false;
        }
        if (count($product->getVariants()) !== 1) {
            return false;
        } else {
            $variant = $product->getVariants()->first();
            if (count($variant->getItemsAttributes()) !== 1) {
                return false;
            } else {
                $itemAttribute = $variant->getItemsAttributes()->first();
                if ($itemAttribute->getName() !== 'Serial Number') {
                    return false;
                } elseif ($itemAttribute->getValue() !== 'default value') {
                    return false;
                }
            }

            if (count($variant->getAttributes())) {
                return false;
            } elseif (count($variant->getPrices())) {
                return false;
            } elseif (count($variant->getCodes())) {
                return false;
            } elseif ($variant->getName() !== 'X-Large') {
                return false;
            } elseif ($variant->getDescription() !== null) {
                return false;
            } elseif ($variant->getNotes() !== null) {
                return false;
            } elseif ($variant->getWeightUnit() !== 'metric') {
                return false;
            } elseif ($variant->getLengthUnit() !== 'metric') {
                return false;
            } elseif ($variant->getWeight() !== null) {
                return false;
            } elseif ($variant->getHeight() !== null) {
                return false;
            } elseif ($variant->getDepth() !== null) {
                return false;
            } elseif ($variant->getWidth() !== null) {
                return false;
            }
        }
        if ($product->getDescription() !== 'This T-Shirt will cover your belly') {
            return false;
        }
        if ($product->getNotes() !== null) {
            return false;
        }
        return true;
    }
}
