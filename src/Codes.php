<?php

namespace Waredesk;

use Waredesk\Mappers\CodeMapper;
use Waredesk\Mappers\CodesMapper;
use Waredesk\Models\Code;

class Codes
{
    private $requestHandler;

    public function __construct(RequestHandler $requestHandler)
    {
        $this->requestHandler = $requestHandler;
    }

    public function create(Code $code): Code
    {
        $response = $this->requestHandler->post(
            '/v1/codes',
            $code
        );
        $code = (new CodeMapper())->map($code, $response);
        return $code;
    }

    /**
     * @return Collections\Codes|Code[]
     */
    public function fetch(): Collections\Codes
    {
        $response = $this->requestHandler->get('/v1/codes');
        return (new CodesMapper())->map(new Collections\Codes(), $response);
    }
}
