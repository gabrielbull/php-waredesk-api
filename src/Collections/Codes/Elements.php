<?php

namespace Waredesk\Collections\Codes;

use Waredesk\Collection;
use Waredesk\Models\Code\Element;

/**
 * @method Element first()
 * @method Element current()
 * @method Element next()
 */
class Elements extends Collection
{
    /**
     * @param Element $item
     */
    public function add($item)
    {
        parent::add($item);
    }
}
