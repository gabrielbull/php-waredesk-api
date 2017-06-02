<?php

namespace Waredesk\Mappers;

use Waredesk\Collections\Categories;
use Waredesk\Mapper;
use Waredesk\Models\Category;

class CategoriesMapper extends Mapper
{
    public function map(Categories $categories, array $data): Categories
    {
        return $this->replace($categories, $data, Category::class, CategoryMapper::class);
    }
}
