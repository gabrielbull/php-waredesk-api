<?php

namespace Waredesk\Collections\Variables;

use Waredesk\Collection;
use Waredesk\Models\Variable\Element;

/**
 * @method Element first()
 * @method Element current()
 * @method Element next()
 * @method Element offsetGet($offset)
 */
class Elements extends Collection
{
    /**
     * @param Element $item
     */
    public function add($item): void
    {
        parent::add($item);
    }
}
