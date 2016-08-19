<?php

namespace Waredesk\Tests;

use PHPUnit\Framework\TestCase;
use Waredesk\Test\Setup;
use Waredesk\Waredesk;

class WaredeskTest extends TestCase
{
    /**
     * @var Waredesk
     */
    private $waredesk;

    public function setUp()
    {
        $this->waredesk = Setup::init();
    }

    public function testGetAccessToken()
    {
        $this->assertNotEmpty($this->waredesk->getAccessToken());
    }
}
