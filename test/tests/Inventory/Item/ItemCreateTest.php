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

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/../../../files/inventory/items/createTestSuccess.json')));
        $item = $this->waredesk->inventory->items->create($item);

        $this->assertNotEmpty($item->getId());
        $this->items[] = $item;
    }

    public function testBatchCreateItems()
    {
        $item1 = $this->inventory->itemsController->createItem();
        $item2 = $this->inventory->itemsController->createItem();

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/../../../files/inventory/items/batchCreateTestSuccess.json')));
        $items = $this->waredesk->inventory->items->batchCreate([$item1, $item2]);

        $this->assertEquals(2, count($items));
        $this->assertInstanceOf(Item::class, $items->offsetGet(0));
        $this->assertInstanceOf(Item::class, $items->offsetGet(1));
        $this->items = array_merge($this->items, $items->toArray());
    }

    public function tearDown()
    {
        foreach ($this->items as $item) {
            $this->mock->append(new Response(200, [], 'true'));
            $this->waredesk->inventory->items->delete($item);
        }
    }
}
