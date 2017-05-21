<?php

namespace Waredesk\Tests;

use Waredesk\Models\Code;

class CollectionTest extends BaseTest
{
    public function testCloneEntityWithCollections()
    {
        $code = new Code();
        $element = new Code\Element();
        $element->setValue('value1');
        $code->getElements()->add($element);

        $code2 = clone $code;
        $element2 = $code2->getElements()->first();
        $element2->setValue('value2');

        $this->assertEquals('value1', $element->getValue());
        $this->assertEquals('value2', $element2->getValue());
    }
}
