<?php

namespace Waredesk\Mappers\Inventory\Item;

use Waredesk\Mapper;
use DateTime;
use Waredesk\Models\Inventory\Item\Activity;

class ActivityMapper extends Mapper
{
    public function map(Activity $activity, array $data): Activity
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'date':
                    $finalData['date'] = new DateTime($value);
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
        $activity->reset($finalData);
        return $activity;
    }
}
