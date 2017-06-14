<?php

namespace Waredesk\Collections\Products\Variants;

use Waredesk\Collection;
use Waredesk\Models\Product\Variant\Code;
use JsonSerializable;

/**
 * @method Code first()
 * @method Code current()
 * @method Code next()
 * @method Code offsetGet($offset)
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

    public function findByValue(string $value): ? Code
    {
        /** @var Code $item */
        foreach ($this->items as $item) {
            if ($item->getValue() === $value) {
                return $item;
            }
        }
        return null;
    }

    public function findByType(string $type): ? Code
    {
        /** @var Code $item */
        foreach ($this->items as $item) {
            if ($item->getType() === $type || $item->getCustomType() === $type) {
                return $item;
            }
        }
        return null;
    }
}
