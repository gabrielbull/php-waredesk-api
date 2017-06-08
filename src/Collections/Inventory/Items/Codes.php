<?php

namespace Waredesk\Collections\Inventory\Items;

use Waredesk\Collection;
use Waredesk\Models\Inventory\Item\Code;

/**
 * @method Code first()
 * @method Code current()
 * @method Code next()
 */
class Codes extends Collection
{
    /**
     * @param Code $item
     */
    public function add($item): void
    {
        parent::add($item);
    }
}
