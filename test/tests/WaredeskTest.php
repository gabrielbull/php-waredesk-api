<?php

namespace Waredesk\Tests;

use GuzzleHttp\Psr7\Response;
use Waredesk\Exceptions\InvalidClientException;

class WaredeskTest extends BaseTest
{
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
