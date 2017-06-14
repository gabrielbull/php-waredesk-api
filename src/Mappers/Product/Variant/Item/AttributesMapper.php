<?php

namespace Waredesk\Mappers\Product\Variant\Item;

use Waredesk\Collections\Products\Variants\Items\Attributes;
use Waredesk\Mapper;
use Waredesk\Models\Product\Variant\Item\Attribute;

class AttributesMapper extends Mapper
{
    public function map(Attributes $attributes, array $data): Attributes
    {
        return $this->replace($attributes, $data, Attribute::class, AttributeMapper::class);
    }
}
