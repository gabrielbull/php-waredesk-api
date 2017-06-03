<?php

namespace Waredesk\Mappers\Product;

use Waredesk\Mapper;
use Waredesk\Models\Product\Category;

class CategoryMapper extends Mapper
{
    public function map(Category $category, $data): Category
    {
        $category->reset($data);
        return $category;
    }
}
