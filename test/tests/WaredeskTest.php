<?php

namespace Waredesk\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Waredesk\Exceptions\InvalidClientException;
use Waredesk\Test\Setup;
use Waredesk\Waredesk;

class WaredeskTest extends TestCase
{
    /**
     * @var Waredesk
     */
    private $waredesk;

    /**
     * @var MockHandler
     */
    private $mock;

    public function setUp()
    {
        [$this->mock, $this->waredesk] = Setup::init();
    }

    public function testGetAccessToken()
    {
        $this->assertNotEmpty($this->waredesk->getAccessToken());
    }

    public function testGetAccessTokenException()
    {
        $response = [
            'error' => 'invalid_client',
            'message' => 'Invalid credentials'
        ];
        $this->mock->append(new Response(400, [], json_encode($response)));
        $this->waredesk->setAccessToken();
        $this->waredesk->setClientId('bad');

        $this->expectException(InvalidClientException::class);
        $this->waredesk->getAccessToken();
    }
}
