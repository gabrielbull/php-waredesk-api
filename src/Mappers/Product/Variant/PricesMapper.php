<?php

namespace Waredesk\Mappers\Product\Variant;

use Waredesk\Collections\Products\Variants\Prices;
use Waredesk\Mapper;
use Waredesk\Models\Product\Variant\Price;

class PricesMapper extends Mapper
{
    public function map(Prices $prices, array $data): Prices
    {
        return $this->replace($prices, $data, Price::class, PriceMapper::class);
    }
}
