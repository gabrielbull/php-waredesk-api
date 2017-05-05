<?php

namespace Waredesk\Mappers\Product\Variant;

use DateTime;
use Waredesk\Models\Product\Variant\Option;

class OptionMapper
{
    public function map(Option $option, $data): Option
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'id':
                    $option->setId((int)$value);
                    break;
                case 'label':
                    $option->setLabel($value);
                    break;
                case 'value':
                    $option->setValue($value);
                    break;
                case 'creation_datetime':
                    $option->setCreationDatetime(new DateTime($value));
                    break;
                case 'modification_datetime':
                    $option->setModificationDatetime(new DateTime($value));
                    break;
            }
        }
        return $option;
    }
}
