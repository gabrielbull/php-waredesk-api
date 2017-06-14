<?php

namespace Waredesk\Collections\Products\Variants;

use Waredesk\Collection;
use Waredesk\Models\Product\Variant\Attribute;

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
