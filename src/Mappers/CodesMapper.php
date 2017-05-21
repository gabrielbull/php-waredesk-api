<?php

namespace Waredesk\Mappers;

use Waredesk\Collections\Codes;
use Waredesk\Mapper;
use Waredesk\Models\Code;

class CodesMapper extends Mapper
{
    public function map(Codes $codes, array $data): Codes
    {
        return $this->replace($codes, $data, Code::class, CodeMapper::class);
    }
}
