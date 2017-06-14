<?php

namespace Waredesk;

use Waredesk\Mappers\VariableMapper;
use Waredesk\Mappers\VariablesMapper;
use Waredesk\Models\Variable;

class Variables
{
    private $requestHandler;

    public function __construct(RequestHandler $requestHandler)
    {
        $this->requestHandler = $requestHandler;
    }

    public function create(Variable $code): Variable
    {
        $response = $this->requestHandler->post(
            '/v1/variables',
            $code
        );
        $code = (new VariableMapper())->map($code, $response);
        return $code;
    }

    /**
     * @return Collections\Variables|Variable[]
     */
    public function fetch(): Collections\Variables
    {
        $response = $this->requestHandler->get('/v1/variables');
        return (new VariablesMapper())->map(new Collections\Variables(), $response);
    }
}
