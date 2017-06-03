<?php

namespace Waredesk\Collections\Products\Variants;

use Waredesk\Collection;
use Waredesk\Models\Product\Variant\Price;

/**
 * @method Price first()
 * @method Price current()
 * @method Price next()
 */
class Prices extends Collection
{
    /**
     * @param Price $item
     */
    public function add($item): void
    {
        parent::add($item);
    }
}
