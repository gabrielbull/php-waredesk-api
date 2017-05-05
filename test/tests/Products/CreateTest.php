<?php

namespace Waredesk\Tests\Products;

use GuzzleHttp\Psr7\Response;
use Waredesk\Models\Product;
use Waredesk\Tests\BaseTest;

class CreateTest extends BaseTest
{
    public function testCreateProduct()
    {
        $product = new Product();
        $product->setName('Amazing T-Shirt');
        $product->setDescription('This T-Shirt will cover your belly');

        $variant = new Product\Variant();
        $variant->setDescription('X-Large');
        $product->getVariants()->add($variant);

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/createTestSuccess.json')));

        $product = $this->waredesk->products->create($product);
        $this->assertNotEmpty($product->getId());
    }
}
