<?php

namespace Waredesk\Mappers\Product\Variant\Item;

use DateTime;
use Waredesk\Mapper;
use Waredesk\Models\Product\Variant\Item\Attribute;

class AttributeMapper extends Mapper
{
    public function map(Attribute $attribute, $data): Attribute
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
        $attribute->reset($finalData);
        return $attribute;
    }
}
