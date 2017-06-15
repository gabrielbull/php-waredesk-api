<?php

namespace Waredesk\Tests\Variables;

use GuzzleHttp\Psr7\Response;
use Waredesk\Tests\BaseTest;

class VariableUpdateTest extends BaseTest
{
    public function testUpdateVariable()
    {
        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/getTestSuccess.json')));
        $variable = $this->waredesk->variables->fetchOne();
        $variable->setName('Black T-Shirt Serial Number');

        $variable->getElements()->first()->setValue('Amazing');

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/updateTestSuccess.json')));
        $variable = $this->waredesk->variables->update($variable);

        $this->assertEquals('Black T-Shirt Serial Number', $variable->getName());
        $this->assertEquals('Amazing', $variable->getElements()->first()->getValue());
    }
}
