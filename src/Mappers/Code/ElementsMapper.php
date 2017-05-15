<?php

namespace Waredesk\Mappers\Code;

use Waredesk\Collections\Codes\Elements;
use Waredesk\Models\Code\Element;

class ElementsMapper
{
    public function map(Elements $elements, array $data): Elements
    {
        foreach ($data as $element) {
            $elements->add((new ElementMapper())->map(new Element(), $element));
        }
        return $elements;
    }
}
