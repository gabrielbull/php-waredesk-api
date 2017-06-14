<?php

namespace Waredesk\Mappers;

use Waredesk\Collections\Variables;
use Waredesk\Mapper;
use Waredesk\Models\Variable;

class VariablesMapper extends Mapper
{
    public function map(Variables $variables, array $data): Variables
    {
        return $this->replace($variables, $data, Variable::class, VariableMapper::class);
    }
}
