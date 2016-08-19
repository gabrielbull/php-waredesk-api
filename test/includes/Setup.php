<?php

namespace Waredesk\Test;

use Waredesk\Waredesk;

class Setup
{
    public static function init(): Waredesk
    {
        $file = __DIR__ . '/../files/accessToken.txt';
        $accessToken = null;
        if (file_exists($file)) {
            $accessToken = file_get_contents($file);
        }
        $waredesk = \Waredesk\Setup::init($_ENV['CLIENT_ID'], $_ENV['CLIENT_SECRET'], $accessToken);
        $waredesk->setApiUrl($_ENV['API_URL']);
        if (!$accessToken) {
            file_put_contents($file, $waredesk->getAccessToken());
        }
        return $waredesk;
    }
}
