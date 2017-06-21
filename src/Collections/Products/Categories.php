<?php

namespace Waredesk\Collections\Products;

use Waredesk\Collection;
use Waredesk\Models\Product\Category;

/**
 * @method Category first()
 * @method Category current()
 * @method Category next()
 * @method Category offsetGet($offset)
 */
class Categories extends Collection
{
    /**
     * @param Category|\Waredesk\Models\Category $item
     */
    public function add($item): void
    {
        if ($item instanceof \Waredesk\Models\Category) {
            $category = new Category($item->getId());
            $category->reset($item->jsonSerialize());
            $item = $category;
        }
        parent::add($item);
    }
}
