<?php

namespace Waredesk\Mappers\Product;

use DateTime;
use Waredesk\Collections\Products\Variants\Annotations;
use Waredesk\Collections\Products\Variants\Codes;
use Waredesk\Collections\Products\Variants\Prices;
use Waredesk\Mapper;
use Waredesk\Mappers\Product\Variant\AnnotationsMapper;
use Waredesk\Mappers\Product\Variant\CodesMapper;
use Waredesk\Mappers\Product\Variant\PricesMapper;
use Waredesk\Models\Product\Variant;

class VariantMapper extends Mapper
{
    public function map(Variant $variant, $data): Variant
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'annotations':
                    $finalData['annotations'] = (new AnnotationsMapper())->map(new Annotations(), $value);
                    break;
                case 'codes':
                    $finalData['codes'] = (new CodesMapper())->map(new Codes(), $value);
                    break;
                case 'prices':
                    $finalData['prices'] = (new PricesMapper())->map(new Prices(), $value);
                    break;
                case 'weight':
                    $finalData['weight'] = (float)$value;
                    break;
                case 'height':
                    $finalData['height'] = (float)$value;
                    break;
                case 'depth':
                    $finalData['depth'] = (float)$value;
                    break;
                case 'width':
                    $finalData['width'] = (float)$value;
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
        $variant->reset($finalData);
        return $variant;
    }
}
