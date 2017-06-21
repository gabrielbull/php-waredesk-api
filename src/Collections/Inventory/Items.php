<?php

namespace Waredesk\Collections\Inventory;

use Waredesk\Collection;
use Waredesk\Models\Inventory\Item;

/**
 * @method Item first()
 * @method Item current()
 * @method Item next()
 * @method Item offsetGet($offset)
 */
class Items extends Collection
{
    /**
     * @param Item $item
     */
    public function add($item): void
    {
        parent::add($item);
    }
}
