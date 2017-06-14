<?php

namespace Waredesk\Tests\Variables;

use GuzzleHttp\Psr7\Response;
use Waredesk\Models\Variable;
use Waredesk\Tests\BaseTest;

class VariablesFetchTest extends BaseTest
{
    public function testFetchCodes()
    {
        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/getTestSuccess.json')));

        $variables = $this->waredesk->variables->fetch();
        $this->assertGreaterThan(0, count($variables));
        $this->assertInstanceOf(Variable::class, $variables->first());
    }
}
