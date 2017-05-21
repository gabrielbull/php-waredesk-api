<?php

namespace Waredesk\Tests\Codes;

use GuzzleHttp\Psr7\Response;
use Waredesk\Models\Code;
use Waredesk\Tests\BaseTest;

class CreateTest extends BaseTest
{
    private function createCode(): Code
    {
        $code = new Code();
        $code->setName('SKU');

        $element = new Code\Element();
        $element->setType('text');
        $code->getElements()->add($element);

        return $code;
    }

    public function testCreateCode()
    {
        $code = $this->createCode();

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/createTestSuccess.json')));

        $code = $this->waredesk->codes->create($code);
        $this->assertNotEmpty($code->getId());
        $this->assertGreaterThanOrEqual(1, count($code->getElements()));
        foreach ($code->getElements() as $element) {
            $this->assertInstanceOf(Code\Element::class, $element);
        }
    }
}
