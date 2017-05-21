<?php

namespace Waredesk\Mappers\Product;

use Waredesk\Collections\Products\Variants;
use Waredesk\Mapper;
use Waredesk\Models\Product\Variant;

class VariantsMapper extends Mapper
{
    public function map(Variants $variants, array $data): Variants
    {
        return $this->replace($variants, $data, Variant::class, VariantMapper::class);
    }
}
