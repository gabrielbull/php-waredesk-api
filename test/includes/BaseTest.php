<?php

namespace Waredesk\Tests;

use GuzzleHttp\Handler\MockHandler;
use PHPUnit\Framework\TestCase;
use Waredesk\Tests\Inventory\ItemsController;
use Waredesk\Waredesk;

abstract class BaseTest extends TestCase
{
    /**
     * @var Waredesk
     */
    public $waredesk;

    /**
     * @var MockHandler
     */
    public $mock;

    /**
     * @var ProductsController
     */
    public $productsController;

    /**
     * @var CategoriesController
     */
    public $categoriesController;

    /**
     * @var Inventory
     */
    public $inventory;

    public function setUp()
    {
        [$this->mock, $this->waredesk] = Setup::init();
        $this->inventory = new Inventory($this);
        $this->productsController = new ProductsController($this);
        $this->categoriesController = new CategoriesController($this);
    }
}
