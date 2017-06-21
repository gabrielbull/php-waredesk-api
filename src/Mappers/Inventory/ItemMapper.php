<?php

namespace Waredesk\Mappers\Inventory;

use Waredesk\Collections\Inventory\Items\Activities;
use Waredesk\Collections\Inventory\Items\Attributes;
use Waredesk\Mapper;
use DateTime;
use Waredesk\Mappers\Inventory\Item\ActivitiesMapper;
use Waredesk\Mappers\Inventory\Item\AttributesMapper;
use Waredesk\Models\Inventory\Item;

class ItemMapper extends Mapper
{
    public function map(Item $item, array $data): Item
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'activities':
                    $finalData['activities'] = (new ActivitiesMapper())->map(new Activities(), $value);
                    break;
                case 'attributes':
                    $finalData['attributes'] = (new AttributesMapper())->map(new Attributes(), $value);
                    break;
                case 'in_stock':
                    $finalData['variants'] = (bool)$value;
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
        $item->reset($finalData);
        return $item;
    }
}
