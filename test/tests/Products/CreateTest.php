<?php

namespace Waredesk\Tests\Products;

use GuzzleHttp\Psr7\Response;
use Waredesk\Image;
use Waredesk\Models\Product;
use Waredesk\Tests\BaseTest;

class CreateTest extends BaseTest
{
    private function createProduct(): Product
    {
        $product = new Product();
        $product->setName('Amazing T-Shirt');
        $product->setDescription('This T-Shirt will cover your belly');

        $variant = new Product\Variant();
        $variant->setDescription('X-Large');
        $product->getVariants()->add($variant);

        return $product;
    }

    public function testCreateProduct()
    {
        $product = $this->createProduct();

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/createTestSuccess.json')));

        $product = $this->waredesk->products->create($product);
        $this->assertNotEmpty($product->getId());
    }

    public function testCreateProductWithImage()
    {
        $image = new Image(__DIR__.'/../files/tshirt.jpg');
        $product = $this->createProduct();
        $product->setImage($image);
        $product->getVariants()->first()->setImage($image);

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/createWithImageTestSuccess.json')));

        $product = $this->waredesk->products->create($product);
        $this->assertNotEmpty($product->getImages()['small']);
        $this->assertNotEmpty($product->getVariants()->first()->getImages()['small']);
    }
}
