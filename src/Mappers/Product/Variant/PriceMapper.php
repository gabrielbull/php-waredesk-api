<?php

namespace Waredesk\Mappers\Product\Variant;

use DateTime;
use Waredesk\Models\Product\Variant\Option;
use Waredesk\Models\Product\Variant\Price;

class PriceMapper
{
    public function map(Price $price, $data): Price
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'id':
                    $price->setId((int)$value);
                    break;
                case 'price_list_id':
                    $price->setPriceListId((int)$value);
                    break;
                case 'currency':
                    $price->setCurrency($value);
                    break;
                case 'price':
                    $price->setPrice((int)$value);
                    break;
                case 'creation_datetime':
                    $price->setCreationDatetime(new DateTime($value));
                    break;
                case 'modification_datetime':
                    $price->setModificationDatetime(new DateTime($value));
                    break;
            }
        }
        return $price;
    }
}
