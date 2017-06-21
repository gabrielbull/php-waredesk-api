<?php

namespace Waredesk\Tests\Products;

use GuzzleHttp\Psr7\Response;
use Waredesk\Exceptions\InvalidRequestException;
use Waredesk\Image;
use Waredesk\Models\Code;
use Waredesk\Models\Product;
use Waredesk\Tests\BaseTest;

class ProductCreateTest extends BaseTest
{
    private function createProduct(): Product
    {
        $product = new Product();
        $product->setName('Amazing T-Shirt');
        $product->setDescription('This T-Shirt will cover your belly');

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/../Categories/responses/getTestSuccess.json')));
        $categories = $this->waredesk->categories->fetch();

        $product->getCategories()->add($categories->first());

        $variant = new Product\Variant();
        $variant->setName('X-Large');
        $product->getVariants()->add($variant);

        return $product;
    }

    public function testCreateProduct()
    {
        $product = $this->createProduct();

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/../../files/products/createTestSuccess.json')));

        $product = $this->waredesk->products->create($product);
        $this->assertNotEmpty($product->getId());

        $this->assertNotEmpty($product->getCategories()->first()->getId());
    }

    public function testCreateProductWithImage()
    {
        $image = new Image(__DIR__ . '/../../files/tshirt.jpg');
        $product = $this->createProduct();
        $product->setImage($image);
        $product->getVariants()->first()->setImage($image);

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/../../files/products/createWithImageTestSuccess.json')));

        $product = $this->waredesk->products->create($product);
        $this->assertNotEmpty($product->getImages()['small']);
        $this->assertNotEmpty($product->getVariants()->first()->getImages()['small']);
    }

    public function testFailure()
    {
        $product = $this->createProduct();
        $product->getVariants()->first()->setName('');

        $this->mock->append(new Response(400, [], file_get_contents(__DIR__ . '/../../files/products/createTestFailure.json')));

        try {
            $this->waredesk->products->create($product);
        } catch (InvalidRequestException $e) {
            $this->assertEquals('Request is invalid', $e->getMessage());
            $expectedError = [
                [
                    'field' => 'variants',
                    'error' => 'child_errors',
                    'message' => 'Field \'variants\' has errors in it\'s children',
                    'errors' => [
                        [
                            [
                                'field' => 'name',
                                'error' => 'invalid',
                                'message' => 'Field \'name\' is invalid',
                            ]
                        ]
                    ]
                ]
            ];
            $this->assertEquals($expectedError, $e->getErrors());
        }
    }
}
