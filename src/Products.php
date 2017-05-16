<?php

namespace Waredesk;

use Waredesk\Mappers\ProductMapper;
use Waredesk\Mappers\ProductsMapper;
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

    /**
     * @return Collections\Products|Product[]
     */
    public function fetch(): Collections\Products
    {
        $response = $this->requestHandler->get('/v1/products');
        return (new ProductsMapper())->map(new Collections\Products(), $response);
    }
}
