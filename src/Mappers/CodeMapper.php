<?php

namespace Waredesk\Mappers;

use Waredesk\Collections\Codes\Elements;
use Waredesk\Mapper;
use Waredesk\Mappers\Code\ElementsMapper;
use Waredesk\Models\Code;
use DateTime;

class CodeMapper extends Mapper
{
    public function map(Code $code, array $data): Code
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'elements':
                    $finalData['elements'] = (new ElementsMapper())->map($code->getElements(), $value);
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
