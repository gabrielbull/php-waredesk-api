<?php

namespace Waredesk\Mappers\Product\Variant;

use Waredesk\Collections\Products\Variants\Codes;
use Waredesk\Models\Product\Variant\Code;

class CodesMapper
{
    public function map(Codes $codes, array $data): Codes
    {
        foreach ($data as $codeData) {
            $codes->add((new CodeMapper())->map(new Code(), $codeData));
        }
        return $codes;
    }
}
