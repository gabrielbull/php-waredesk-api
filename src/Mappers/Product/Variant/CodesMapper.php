<?php

namespace Waredesk\Mappers\Product\Variant;

use Waredesk\Collections\Products\Variants\Codes;
use Waredesk\Mapper;
use Waredesk\Models\Product\Variant\Code;

class CodesMapper extends Mapper
{
    public function map(Codes $codes, array $data): Codes
    {
        return $this->create($codes, $data, Code::class, CodeMapper::class);
    }
}
