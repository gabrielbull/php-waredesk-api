<?php

namespace Waredesk\Mappers\Inventory\Item;

use Waredesk\Collections\Inventory\Items\Codes;
use Waredesk\Mapper;
use Waredesk\Models\Inventory\Item\Code;

class CodesMapper extends Mapper
{
    public function map(Codes $codes, array $data): Codes
    {
        return $this->replace($codes, $data, Code::class, CodeMapper::class);
    }
}
