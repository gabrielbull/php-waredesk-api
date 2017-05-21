<?php

namespace Waredesk\Mappers\Code;

use Waredesk\Collections\Codes\Elements;
use Waredesk\Mapper;
use Waredesk\Models\Code\Element;

class ElementsMapper extends Mapper
{
    public function map(Elements $elements, array $data): Elements
    {
        return $this->replace($elements, $data, Element::class, ElementMapper::class);
    }
}
