<?php

namespace Waredesk\Mappers\Inventory;

use Waredesk\Collections\Inventory\Items\Activities;
use Waredesk\Collections\Inventory\Items\Codes;
use Waredesk\Mapper;
use DateTime;
use Waredesk\Mappers\Inventory\Item\ActivitiesMapper;
use Waredesk\Mappers\Inventory\Item\CodesMapper;
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
                case 'codes':
                    $finalData['codes'] = (new CodesMapper())->map(new Codes(), $value);
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
