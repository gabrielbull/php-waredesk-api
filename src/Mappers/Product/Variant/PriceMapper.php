<?php

namespace Waredesk\Mappers\Product\Variant;

use DateTime;
use Waredesk\Mapper;
use Waredesk\Models\Product\Variant\Price;

class PriceMapper extends Mapper
{
    public function map(Price $price, $data): Price
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'price':
                    $finalData['price'] = (int)$value;
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
        $price->reset($finalData);
        return $price;
    }
}
