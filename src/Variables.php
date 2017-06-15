<?php

namespace Waredesk;

use Waredesk\Mappers\VariableMapper;
use Waredesk\Mappers\VariablesMapper;
use Waredesk\Models\Variable;

class Variables extends Controller
{
    public function create(Variable $code): Variable
    {
        return $this->doCreate('/v1/variables', $code, function ($response) use ($code) {
            return (new VariableMapper())->map($code, $response);
        });
    }

    /**
     * @return Collections\Variables|Variable[]
     */
    public function fetch(): Collections\Variables
    {
        return $this->doFetch('/v1/variables', function ($response) {
            return (new VariablesMapper())->map(new Collections\Variables(), $response);
        });
    }

    public function fetchOne(string $orderBy = null, string $order = self::ORDER_BY_ASC): ? Variable
    {
        return $this->doFetchOne('/v1/variables', $orderBy, $order, function ($response) {
            return (new VariablesMapper())->map(new Collections\Variables(), $response);
        });
    }
}
