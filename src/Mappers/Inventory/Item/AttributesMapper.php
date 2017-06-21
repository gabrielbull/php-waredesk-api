<?php

namespace Waredesk\Mappers\Inventory\Item;

use Waredesk\Collections\Inventory\Items\Attributes;
use Waredesk\Mapper;
use Waredesk\Models\Inventory\Item\Attribute;

class AttributesMapper extends Mapper
{
    public function map(Attributes $attributes, array $data): Attributes
    {
        return $this->replace($attributes, $data, Attribute::class, AttributeMapper::class);
    }
}
