<?php

namespace Waredesk\Tests;

use Waredesk\Tests\Inventory\ItemsController;

class Inventory
{
    /**
     * @var BaseTest
     */
    protected $baseTest;

    public function __construct(BaseTest $baseTest)
    {
        $this->baseTest = $baseTest;
        $this->itemsController = new ItemsController($this->baseTest);
    }
}
