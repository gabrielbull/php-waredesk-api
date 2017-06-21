<?php

namespace Waredesk\Collections\Products;

use Waredesk\Collection;
use Waredesk\Models\Product\Variant;

/**
 * @method Variant first()
 * @method Variant current()
 * @method Variant next()
 * @method Variant offsetGet($offset)
 */
class Variants extends Collection
{
    /**
     * @param Variant $item
     */
    public function add($item): void
    {
        parent::add($item);
    }
}
