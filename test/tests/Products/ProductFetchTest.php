<?php

namespace Waredesk\Tests\Products;

use GuzzleHttp\Psr7\Response;
use Waredesk\Image;
use Waredesk\Models\Product;
use Waredesk\Tests\BaseTest;

class ProductFetchTest extends BaseTest
{
    public function testFetchProduct()
    {
        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/../../files/products/getTestSuccess.json')));

        $products = $this->waredesk->products->fetch();
        $this->assertGreaterThan(0, count($products));
        $this->assertInstanceOf(Product::class, $products->first());
    }
}
