<?php

namespace Waredesk\Inventory;

use Waredesk\Mappers\Inventory\ItemMapper;
use Waredesk\Mappers\Inventory\ItemsMapper;
use Waredesk\Models\Inventory\Item;
use Waredesk\RequestHandler;

class Items
{
    private $requestHandler;

    public function __construct(RequestHandler $requestHandler)
    {
        $this->requestHandler = $requestHandler;
    }

    public function create(Item $item): Item
    {
        $response = $this->requestHandler->post(
            '/v1-alpha/inventory/items',
            $item
        );
        $item = (new ItemMapper())->map($item, $response);
        return $item;
    }

    /**
     * @return \Waredesk\Collections\Inventory\Items|Item[]
     */
    public function fetch(): \Waredesk\Collections\Inventory\Items
    {
        $response = $this->requestHandler->get('/v1-alpha/inventory/items');
        return (new ItemsMapper())->map(new \Waredesk\Collections\Inventory\Items(), $response);
    }
}
