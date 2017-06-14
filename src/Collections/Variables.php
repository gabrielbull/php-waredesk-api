<?php

namespace Waredesk\Collections;

use Waredesk\Collection;
use Waredesk\Models\Variable;

/**
 * @method Variable first()
 * @method Variable current()
 * @method Variable next()
 */
class Variables extends Collection
{
    /**
     * @param Variable $item
     */
    public function add($item): void
    {
        parent::add($item);
    }
}
