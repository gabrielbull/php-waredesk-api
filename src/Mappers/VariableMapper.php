<?php

namespace Waredesk\Mappers;

use Waredesk\Collections\Variables\Elements;
use Waredesk\Mapper;
use Waredesk\Mappers\Variable\ElementsMapper;
use Waredesk\Models\Variable;
use DateTime;

class VariableMapper extends Mapper
{
    public function map(Variable $variable, array $data): Variable
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
        $variable->reset($finalData);
        return $variable;
    }
}
