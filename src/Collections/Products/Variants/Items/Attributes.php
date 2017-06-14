<?php

namespace Waredesk\Collections\Products\Variants\Items;

use Waredesk\Collection;
use Waredesk\Models\Product\Variant\Item\Attribute;

/**
 * @method Attribute first()
 * @method Attribute current()
 * @method Attribute next()
 */
class Attributes extends Collection
{
    /**
     * @param Attribute $item
     */
    public function add($item): void
    {
        parent::add($item);
    }
}
