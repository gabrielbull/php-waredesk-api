<?php

namespace Waredesk;

use Waredesk\Inventory\Items;

class Inventory
{
    private $requestHandler;

    /**
     * @var Items
     */
    public $items;

    public function __construct(RequestHandler $requestHandler)
    {
        $this->requestHandler = $requestHandler;
        $this->items = new Items($requestHandler);
    }
}
