<?php

namespace Waredesk\Tests\Inventory\Item;

use GuzzleHttp\Psr7\Response;
use Waredesk\Models\Inventory\Item;
use Waredesk\Tests\BaseTest;

class ItemFetchTest extends BaseTest
{
    public function testFetchItems()
    {
        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/../../../files/inventory/items/getTestSuccess.json')));

        $items = $this->waredesk->inventory->items->fetch();
        $this->assertGreaterThan(0, count($items));
        $this->assertInstanceOf(Item::class, $items->first());
    }
}
