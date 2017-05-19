<?php

namespace Waredesk\Mappers\Product\Variant\Code;

use Waredesk\Models\Product\Variant\Code\Element;

class ElementMapper
{
    public function map(Element $element, $data): Element
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'auto_increment':
                    $finalData['auto_increment'] = (bool)$value;
                    break;
                case 'pad_length':
                    $finalData['pad_length'] = (int)$value;
                    break;
                default:
                    $finalData[$key] = $value;
                    break;
            }
        }
        $element->reset($finalData);
        return $element;
    }
}
