<?php

namespace Waredesk\Collections;

use Waredesk\Collection;
use Waredesk\Models\Product;

/**
 * @method Product first()
 * @method Product current()
 * @method Product next()
 */
class Products extends Collection
{
    /**
     * @param Product $item
     */
    public function add($item)
    {
        parent::add($item);
    }
}
