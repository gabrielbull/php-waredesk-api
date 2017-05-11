<?php

namespace Waredesk\Mappers\Product;

use DateTime;
use Waredesk\Collections\Products\Variants\Codes;
use Waredesk\Collections\Products\Variants\Options;
use Waredesk\Collections\Products\Variants\Prices;
use Waredesk\Mappers\Product\Variant\CodesMapper;
use Waredesk\Mappers\Product\Variant\OptionsMapper;
use Waredesk\Mappers\Product\Variant\PricesMapper;
use Waredesk\Models\Product\Variant;

class VariantMapper
{
    public function map(Variant $variant, $data): Variant
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'id':
                    $finalData['id'] = (int)$value;
                    break;
                case 'options':
                    $finalData['options'] = (new OptionsMapper())->map(new Options(), $value);
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
                case 'creation_datetime':
                    $finalData['creation_datetime'] = new DateTime($value);
                    break;
                case 'modification_datetime':
                    $finalData['modification_datetime'] = new DateTime($value);
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
