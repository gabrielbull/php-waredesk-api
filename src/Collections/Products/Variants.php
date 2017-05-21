<?php

namespace Waredesk\Collections\Products;

use Waredesk\Collection;
use Waredesk\Models\Product\Variant;

/**
 * @method Variant first()
 * @method Variant current()
 * @method Variant next()
 */
class Variants extends Collection
{
    /**
     * @param Variant $item
     */
    public function add($item)
    {
        parent::add($item);
    }
}
