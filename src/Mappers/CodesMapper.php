<?php

namespace Waredesk\Mappers;

use Waredesk\Collections\Codes;
use Waredesk\Models\Code;

class CodesMapper
{
    public function map(Codes $codes, array $data): Codes
    {
        foreach ($data as $code) {
            $codes->add((new CodeMapper())->map(new Code(), $code));
        }
        return $codes;
    }
}
