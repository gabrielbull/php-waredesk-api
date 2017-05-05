<?php

namespace Waredesk\Mappers\Product\Variant;

use Waredesk\Collections\Products\Variants\Prices;
use Waredesk\Models\Product\Variant\Price;

class PricesMapper
{
    public function map(Prices $prices, array $data): Prices
    {
        foreach ($data as $priceData) {
            $prices->add((new PriceMapper())->map(new Price(), $priceData));
        }
        return $prices;
    }
}
