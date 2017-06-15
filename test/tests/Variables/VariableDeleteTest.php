<?php

namespace Waredesk\Tests\Variables;

use GuzzleHttp\Psr7\Response;
use Waredesk\Tests\BaseTest;

class VariableDeleteTest extends BaseTest
{
    public function testDeleteVariable()
    {
        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/getTestSuccess.json')));
        $variable = $this->waredesk->variables->fetchOne();

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/deleteTestSuccess.json')));
        $result = $this->waredesk->variables->delete($variable);

        $this->assertEquals(true, $result);
    }
}
