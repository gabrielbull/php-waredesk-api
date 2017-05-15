<?php

namespace Waredesk\Mappers;

use Waredesk\Collections\Products\Variants;
use Waredesk\Mappers\Product\VariantsMapper;
use Waredesk\Models\Product;
use DateTime;

class ProductMapper
{
    public function map(Product $product, array $data): Product
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
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
