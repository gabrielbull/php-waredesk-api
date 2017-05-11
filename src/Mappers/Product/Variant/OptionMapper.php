<?php

namespace Waredesk\Mappers\Product\Variant;

use DateTime;
use Waredesk\Models\Product\Variant\Option;

class OptionMapper
{
    public function map(Option $option, $data): Option
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'id':
                    $finalData['id'] = (int)$value;
                    break;
                case 'label':
                    $finalData['label'] = $value;
                    break;
                case 'value':
                    $finalData['value'] = $value;
                    break;
                case 'creation_datetime':
                    $finalData['creation_datetime'] = new DateTime($value);
                    break;
                case 'modification_datetime':
                    $finalData['modification_datetime'] = new DateTime($value);
                    break;
            }
        }
        $option->reset($finalData);
        return $option;
    }
}
