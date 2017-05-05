<?php

namespace Waredesk\Mappers\Product;

use Waredesk\Collections\Products\Variants;
use Waredesk\Models\Product\Variant;

class VariantsMapper
{
    public function map(Variants $variants, array $data): Variants
    {
        foreach ($data as $variantData) {
            $variants->add((new VariantMapper())->map(new Variant(), $variantData));
        }
        return $variants;
    }
}
