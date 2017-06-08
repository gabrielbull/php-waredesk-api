<?php

namespace Waredesk\Mappers\Inventory\Item;

use Waredesk\Mapper;
use Waredesk\Models\Inventory\Item\Code;

class CodeMapper extends Mapper
{
    public function map(Code $code, array $data): Code
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                default:
                    $finalData[$key] = $value;
                    break;
            }
        }
        $code->reset($finalData);
        return $code;
    }
}
