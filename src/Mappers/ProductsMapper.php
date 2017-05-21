<?php

namespace Waredesk\Mappers;

use Waredesk\Collections\Products;
use Waredesk\Mapper;
use Waredesk\Models\Product;

class ProductsMapper extends Mapper
{
    public function map(Products $products, array $data): Products
    {
        return $this->replace($products, $data, Product::class, ProductMapper::class);
    }
}
