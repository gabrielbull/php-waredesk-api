<?php

namespace Waredesk\Mappers\Inventory\Item;

use Waredesk\Collections\Inventory\Items\Activities;
use Waredesk\Mapper;
use Waredesk\Models\Inventory\Item\Activity;

class ActivitiesMapper extends Mapper
{
    public function map(Activities $activities, array $data): Activities
    {
        return $this->replace($activities, $data, Activity::class, ActivityMapper::class);
    }
}
