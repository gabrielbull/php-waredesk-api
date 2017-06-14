<?php

namespace Waredesk\Tests;

use Waredesk\Models\Variable;

class CollectionTest extends BaseTest
{
    public function testCloneEntityWithCollections()
    {
        $variable = new Variable();
        $element = new Variable\Element();
        $element->setValue('value1');
        $variable->getElements()->add($element);

        $variable2 = clone $variable;
        $element2 = $variable2->getElements()->first();
        $element2->setValue('value2');

        $this->assertEquals('value1', $element->getValue());
        $this->assertEquals('value2', $element2->getValue());
    }
}
