<?php

namespace Waredesk\Mappers\Product\Variant\Code;

use Waredesk\Collections\Products\Variants\Codes\Elements;
use Waredesk\Mapper;
use Waredesk\Models\Product\Variant\Code\Element;

class ElementsMapper extends Mapper
{
    public function map(Elements $elements, array $data): Elements
    {
        return $this->create($elements, $data, Element::class, ElementMapper::class);
    }
}
