<?php

namespace Waredesk\Collections;

use Waredesk\Collection;
use Waredesk\Models\Category;

/**
 * @method Category first()
 * @method Category current()
 * @method Category next()
 */
class Categories extends Collection
{
    /**
     * @param Category $item
     */
    public function add($item)
    {
        parent::add($item);
    }
}
