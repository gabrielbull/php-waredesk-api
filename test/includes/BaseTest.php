<?php

namespace Waredesk\Tests;

use GuzzleHttp\Handler\MockHandler;
use PHPUnit\Framework\TestCase;
use Waredesk\Waredesk;

abstract class BaseTest extends TestCase
{
    /**
     * @var Waredesk
     */
    protected $waredesk;

    /**
     * @var MockHandler
     */
    protected $mock;

    public function setUp()
    {
        [$this->mock, $this->waredesk] = Setup::init();
    }
}
