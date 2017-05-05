<?php

namespace Waredesk;

use Waredesk\Mappers\ProductMapper;
use Waredesk\Models\Product;

class Products
{
    private $requestHandler;

    public function __construct(RequestHandler $requestHandler)
    {
        $this->requestHandler = $requestHandler;
    }

    public function create(Product $product): Product
    {
        $response = $this->requestHandler->post(
            '/v1/products',
            $product
        );
        $product = (new ProductMapper())->map($product, $response);
        return $product;
    }
}
