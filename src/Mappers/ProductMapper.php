<?php

namespace Waredesk\Mappers;

use Waredesk\Collections\Products\Variants;
use Waredesk\Mappers\Product\VariantsMapper;
use Waredesk\Models\Product;
use DateTime;

class ProductMapper
{
    public function map(Product $product, array $data): Product
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'id':
                    $product->setId((int)$value);
                    break;
                case 'images':
                    $product->setImages($value);
                    break;
                case 'variants':
                    $product->setVariants((new VariantsMapper())->map(new Variants(), $value));
                    break;
                case 'name':
                    $product->setName($value);
                    break;
                case 'description':
                    $product->setDescription($value);
                    break;
                case 'notes':
                    $product->setNotes($value);
                    break;
                case 'creation_datetime':
                    $product->setCreationDatetime(new DateTime($value));
                    break;
                case 'modification_datetime':
                    $product->setModificationDatetime(new DateTime($value));
                    break;
            }
        }
        return $product;
    }
}
