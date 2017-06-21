<?php

namespace Waredesk\Mappers\Inventory\Item;

use DateTime;
use Waredesk\Mapper;
use Waredesk\Models\Inventory\Item\Attribute;

class AttributeMapper extends Mapper
{
    public function map(Attribute $attribute, array $data): Attribute
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
