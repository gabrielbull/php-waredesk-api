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
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'id':
                    $variant->setId((int)$value);
                    break;
                case 'images':
                    $variant->setImages($value);
                    break;
                case 'options':
                    $variant->setOptions((new OptionsMapper())->map(new Options(), $value));
                    break;
                case 'codes':
                    $variant->setCodes((new CodesMapper())->map(new Codes(), $value));
                    break;
                case 'prices':
                    $variant->setPrices((new PricesMapper())->map(new Prices(), $value));
                    break;
                case 'description':
                    $variant->setDescription($value);
                    break;
                case 'notes':
                    $variant->setNotes($value);
                    break;
                case 'weight_unit':
                    $variant->setWeightUnit($value);
                    break;
                case 'length_unit':
                    $variant->setLengthUnit($value);
                    break;
                case 'weight':
                    $variant->setWeight((float)$value);
                    break;
                case 'height':
                    $variant->setHeight((float)$value);
                    break;
                case 'depth':
                    $variant->setDepth((float)$value);
                    break;
                case 'width':
                    $variant->setWidth((float)$value);
                    break;
                case 'creation_datetime':
                    $variant->setCreationDatetime(new DateTime($value));
                    break;
                case 'modification_datetime':
                    $variant->setModificationDatetime(new DateTime($value));
                    break;
            }
        }
        return $variant;
    }
}
