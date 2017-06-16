<?php

namespace Waredesk\Tests\Variables;

use GuzzleHttp\Psr7\Response;
use Waredesk\Models\Variable;
use Waredesk\Tests\BaseTest;

class VariableCreateTest extends BaseTest
{
    private function createVariable(): Variable
    {
        $variable = new Variable();
        $variable->setName('T-Shirt Serial Number');

        $element = new Variable\Element();
        $element->setType('text');
        $variable->getElements()->add($element);

        return $variable;
    }

    public function testCreateVariable()
    {
        $variable = $this->createVariable();

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/createTestSuccess.json')));

        $variable = $this->waredesk->variables->create($variable);
        $this->assertNotEmpty($variable->getId());
        $this->assertEquals(1, count($variable->getElements()));
        foreach ($variable->getElements() as $element) {
            $this->assertInstanceOf(Variable\Element::class, $element);
        }
    }
}
