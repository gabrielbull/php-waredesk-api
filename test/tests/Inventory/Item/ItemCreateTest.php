<?php

namespace Waredesk\Tests\Inventory\Item;

use GuzzleHttp\Psr7\Response;
use Waredesk\Models\Inventory\Item;
use Waredesk\Tests\BaseTest;

class ItemCreateTest extends BaseTest
{
    private function createItem(): Item
    {
        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/../../Products/responses/getTestSuccess.json')));
        $products = $this->waredesk->products->fetch();

        $item = new Item();
        $item->setVariant($products->first()->getVariants()->first()->getId());

        return $item;
    }

    public function testCreateItem()
    {
        $item = $this->createItem();

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/createTestSuccess.json')));

        $item = $this->waredesk->inventory->items->create($item);
        $this->assertNotEmpty($item->getId());
    }
}
