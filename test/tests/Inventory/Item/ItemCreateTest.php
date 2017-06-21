<?php

namespace Waredesk\Tests\Inventory\Item;

use GuzzleHttp\Psr7\Response;
use Waredesk\Models\Inventory\Item;
use Waredesk\Tests\BaseTest;

class ItemCreateTest extends BaseTest
{
    private $items = [];

    public function testCreateItem()
    {
        $item = $this->inventory->itemsController->createItem();
        $item->getAttributes()->first()->setValue('final value');

        //$this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/createTestSuccess.json')));
        $item = $this->waredesk->inventory->items->create($item);

        $this->assertNotEmpty($item->getId());
        $this->items[] = $item;
    }

    public function tearDown()
    {
        foreach ($this->items as $item) {
            $this->waredesk->inventory->items->delete($item);
        }
    }
}
