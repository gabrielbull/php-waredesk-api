<?php

namespace Waredesk;

use Waredesk\Mappers\ProductMapper;
use Waredesk\Mappers\ProductsMapper;
use Waredesk\Models\Product;

class Products extends Controller
{
    private const ENDPOINT = '/v1-alpha/products';

    public function create(Product $product): Product
    {
        return $this->doCreate(
            self::ENDPOINT,
            $product,
            function ($response) use ($product) {
                return (new ProductMapper())->map($product, $response);
            }
        );
    }

    public function update(Product $product): Product
    {
        $this->validateIsNotNewEntity($product->getId());
        return $this->doUpdate(
            self::ENDPOINT."/{$product->getId()}",
            $product,
            function ($response) use ($product) {
                return (new ProductMapper())->map($product, $response);
            }
        );
    }

    public function fetch(string $orderBy = null, string $order = self::ORDER_BY_ASC, int $limit = null): Collections\Products
    {
        return $this->doFetch(
            self::ENDPOINT,
            $orderBy,
            $order,
            $limit,
            function ($response) {
                return (new ProductsMapper())->map(new Collections\Products(), $response);
            }
        );
    }

    public function fetchOne(string $orderBy = null, string $order = self::ORDER_BY_ASC): ? Product
    {
        return $this->doFetchOne(
            self::ENDPOINT,
            $orderBy,
            $order,
            function ($response) {
                return (new ProductsMapper())->map(new Collections\Products(), $response);
            }
        );
    }

    public function findOneBy(array $criteria, string $orderBy = null, string $order = self::ORDER_BY_ASC): ? Product
    {
        return $this->doFindOneBy(
            self::ENDPOINT,
            $criteria,
            $orderBy,
            $order,
            function ($response) {
                return (new ProductsMapper())->map(new Collections\Products(), $response);
            }
        );
    }
}
