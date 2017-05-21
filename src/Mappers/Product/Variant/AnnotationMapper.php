<?php

namespace Waredesk\Mappers\Product\Variant;

use DateTime;
use Waredesk\Mapper;
use Waredesk\Models\Product\Variant\Annotation;

class AnnotationMapper extends Mapper
{
    public function map(Annotation $option, $data): Annotation
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
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
        $option->reset($finalData);
        return $option;
    }
}
