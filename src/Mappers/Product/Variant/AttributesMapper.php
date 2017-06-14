<?php

namespace Waredesk\Mappers\Product\Variant;

use Waredesk\Collections\Products\Variants\Attributes;
use Waredesk\Mapper;
use Waredesk\Models\Product\Variant\Attribute;

class AttributesMapper extends Mapper
{
    public function map(Attributes $attributes, array $data): Attributes
    {
        return $this->replace($attributes, $data, Attribute::class, AttributeMapper::class);
    }
}
