<?php

namespace Waredesk\Mappers\Product;

use Waredesk\Collections\Products\Categories;
use Waredesk\Mapper;
use Waredesk\Models\Product\Category;

class CategoriesMapper extends Mapper
{
    public function map(Categories $categories, array $data): Categories
    {
        $categories->reset();
        foreach ($data as $item) {
            $categories->add((new CategoryMapper())->map(new Category($item['id']), $item));
        }
        return $categories;
    }
}
