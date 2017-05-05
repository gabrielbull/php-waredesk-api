<?php

namespace Waredesk\Mappers\Product\Variant;

use DateTime;
use Waredesk\Models\Product\Variant\Code;

class CodeMapper
{
    public function map(Code $code, $data): Code
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'id':
                    $code->setId((int)$value);
                    break;
                case 'label':
                    $code->setLabel($value);
                    break;
                case 'value':
                    $code->setValue($value);
                    break;
                case 'creation_datetime':
                    $code->setCreationDatetime(new DateTime($value));
                    break;
                case 'modification_datetime':
                    $code->setModificationDatetime(new DateTime($value));
                    break;
            }
        }
        return $code;
    }
}
