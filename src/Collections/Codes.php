<?php

namespace Waredesk\Collections;

use Waredesk\Collection;
use Waredesk\Models\Code;

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
