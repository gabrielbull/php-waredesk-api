<?php

namespace Waredesk\Mappers\Product\Variant;

use DateTime;
use Waredesk\Models\Product\Variant\Option;
use Waredesk\Models\Product\Variant\Price;

class PriceMapper
{
    public function map(Price $price, $data): Price
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'id':
                    $finalData['id'] = (int)$value;
                    break;
                case 'price_list_id':
                    $finalData['price_list_id'] = (int)$value;
                    break;
                case 'currency':
                    $finalData['value'] = $value;
                    break;
                case 'price':
                    $finalData['price'] = (int)$value;
                    break;
                case 'creation_datetime':
                    $finalData['creation_datetime'] = new DateTime($value);
                    break;
                case 'modification_datetime':
                    $finalData['modification_datetime'] = new DateTime($value);
                    break;
            }
        }
        $price->reset($finalData);
        return $price;
    }
}
