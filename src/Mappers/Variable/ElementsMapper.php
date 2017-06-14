<?php

namespace Waredesk\Mappers\Variable;

use Waredesk\Collections\Variables\Elements;
use Waredesk\Mapper;
use Waredesk\Models\Variable\Element;

class ElementsMapper extends Mapper
{
    public function map(Elements $elements, array $data): Elements
    {
        return $this->replace($elements, $data, Element::class, ElementMapper::class);
    }
}
