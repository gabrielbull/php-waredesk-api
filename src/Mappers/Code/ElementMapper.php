<?php

namespace Waredesk\Mappers\Code;

use Waredesk\Mapper;
use Waredesk\Models\Code\Element;

class ElementMapper extends Mapper
{
    public function map(Element $element, $data): Element
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'auto_increment':
                    $finalData['auto_increment'] = (bool)$value;
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
