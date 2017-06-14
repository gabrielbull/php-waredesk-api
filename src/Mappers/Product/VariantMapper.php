<?php

namespace Waredesk\Mappers\Product;

use DateTime;
use Waredesk\Collections\Products\Variants\Items\Attributes as ItemsAttributes;
use Waredesk\Collections\Products\Variants\Attributes;
use Waredesk\Collections\Products\Variants\Codes;
use Waredesk\Collections\Products\Variants\Prices;
use Waredesk\Mapper;
use Waredesk\Mappers\Product\Variant\Item\AttributesMapper as ItemAttributesMapper;
use Waredesk\Mappers\Product\Variant\AttributesMapper;
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
                case 'attributes':
                    $finalData['attributes'] = (new AttributesMapper())->map(new Attributes(), $value);
                    break;
                case 'codes':
                    $finalData['codes'] = (new CodesMapper())->map(new Codes(), $value);
                    break;
                case 'prices':
                    $finalData['prices'] = (new PricesMapper())->map(new Prices(), $value);
                    break;
                case 'items_attributes':
                    $finalData['items_attributes'] = (new ItemAttributesMapper())->map(new ItemsAttributes(), $value);
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
