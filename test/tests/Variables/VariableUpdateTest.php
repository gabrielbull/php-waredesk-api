<?php

namespace Waredesk\Tests\Variables;

use GuzzleHttp\Psr7\Response;
use Waredesk\Models\Variable;
use Waredesk\Tests\BaseTest;

class VariableUpdateTest extends BaseTest
{
    public function testTest()
    {
        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/getTestSuccess.json')));
        $variable = $this->waredesk->variables->fetchOne();
        //$this->assertGreaterThan(0, count($variables));
        //$this->assertInstanceOf(Variable::class, $variables->first());
    }
}
