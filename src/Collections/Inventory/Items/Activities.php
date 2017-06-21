<?php

namespace Waredesk\Collections\Inventory\Items;

use Waredesk\Collection;
use Waredesk\Models\Inventory\Item\Activity;

/**
 * @method Activity first()
 * @method Activity current()
 * @method Activity next()
 * @method Activity offsetGet($offset)
 */
class Activities extends Collection
{
    /**
     * @param Activity $item
     */
    public function add($item): void
    {
        parent::add($item);
    }
}
