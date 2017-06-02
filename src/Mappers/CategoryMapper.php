<?php

namespace Waredesk\Mappers;

use Waredesk\Mapper;
use Waredesk\Models\Category;
use DateTime;

class CategoryMapper extends Mapper
{
    public function map(Category $category, array $data): Category
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'creation':
                    $finalData['creation'] = new DateTime($value);
                    break;
                case 'modification':
                    $finalData['modification'] = new DateTime($value);
                    break;
                default:
                    $finalData[$key] = $value;
                    break;
            }
        }
        $category->reset($finalData);
        return $category;
    }
}
