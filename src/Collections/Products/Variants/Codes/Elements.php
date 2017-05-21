<?php

namespace Waredesk\Collections\Products\Variants\Codes;

use Waredesk\Collection;
use Waredesk\Models\Product\Variant\Code\Element;

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
