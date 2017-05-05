<?php

namespace Waredesk\Test;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

class Setup
{
    public static function init(): array
    {
        $file = __DIR__ . '/../files/accessToken.txt';
        $accessToken = null;
        if (file_exists($file)) {
            $accessToken = file_get_contents($file);
        }
        $waredesk = \Waredesk\Setup::init($_ENV['CLIENT_ID'], $_ENV['CLIENT_SECRET'], $accessToken);
        $waredesk->setApiUrl($_ENV['API_URL']);
        if (!$accessToken) {
            if ($_ENV['MOCK'] == '1') {
                $waredesk->setAccessToken('mock');
            } else {
                file_put_contents($file, $waredesk->getAccessToken());
            }
        }
        $mock = new MockHandler();
        if ($_ENV['MOCK'] == '1') {
            $handler = HandlerStack::create($mock);
            $waredesk->setMockHandler($handler);
        }

        return [$mock, $waredesk];
    }
}
