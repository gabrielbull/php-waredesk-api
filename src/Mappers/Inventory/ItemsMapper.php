<?php

namespace Waredesk\Mappers\Inventory;

use Waredesk\Collections\Inventory\Items;
use Waredesk\Mapper;
use Waredesk\Models\Inventory\Item;

class ItemsMapper extends Mapper
{
    public function map(Items $items, array $data): Items
    {
        return $this->replace($items, $data, Item::class, ItemMapper::class);
    }
}
