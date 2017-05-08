<?php

namespace Waredesk\Mappers;

use Waredesk\Collections\Products;
use Waredesk\Models\Product;

class ProductsMapper
{
    public function map(Products $products, array $data): Products
    {
        foreach ($data as $productData) {
            $products->add((new ProductMapper())->map(new Product(), $productData));
        }
        return $products;
    }
}
