<?php

namespace Waredesk\Mappers\Product\Variant;

use DateTime;
use Waredesk\Collections\Products\Variants\Codes\Elements;
use Waredesk\Mapper;
use Waredesk\Mappers\Product\Variant\Code\ElementsMapper;
use Waredesk\Models\Product\Variant\Code;

class CodeMapper extends Mapper
{
    public function map(Code $code, $data): Code
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'quantity':
                    $finalData['quantity'] = (int)$value;
                    break;
                case 'elements':
                    $finalData['elements'] = (new ElementsMapper())->map(new Elements(), $value);
                    break;
                case 'creation':
                    $finalData['creation'] = new DateTime($value);
                    break;
                case 'modification':
                    $finalData['modification'] = new DateTime($value);
                    break;
                default:
                    $finalData[$key] = $value;
                    break;
            }
        }
        $code->reset($finalData);
        return $code;
    }
}
