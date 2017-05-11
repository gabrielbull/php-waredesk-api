<?php

namespace Waredesk\Mappers\Product\Variant;

use DateTime;
use Waredesk\Models\Product\Variant\Code;

class CodeMapper
{
    public function map(Code $code, $data): Code
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
        $code->reset($finalData);
        return $code;
    }
}
