<?php

namespace Waredesk\Mappers;

use Waredesk\Collections\Products\Categories;
use Waredesk\Collections\Products\Variants;
use Waredesk\Mapper;
use Waredesk\Mappers\Product\VariantsMapper;
use Waredesk\Mappers\Product\CategoriesMapper;
use Waredesk\Models\Product;
use DateTime;

class ProductMapper extends Mapper
{
    public function map(Product $product, array $data): Product
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'categories':
                    $finalData['categories'] = (new CategoriesMapper())->map(new Categories(), $value);
                    break;
                case 'variants':
                    $finalData['variants'] = (new VariantsMapper())->map(new Variants(), $value);
                    break;
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
        $product->reset($finalData);
        return $product;
    }
}
