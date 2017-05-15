<?php

namespace Waredesk\Mappers\Product\Variant\Code;

use Waredesk\Collections\Products\Variants\Codes\Elements;
use Waredesk\Models\Product\Variant\Code\Element;

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
