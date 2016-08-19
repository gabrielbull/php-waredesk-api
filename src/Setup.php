<?php

namespace Waredesk;

class Setup
{
    public static function init(string $clientId, string $clientSecret, string $accessToken = null): Waredesk
    {
        return new Waredesk($clientId, $clientSecret, $accessToken);
    }
}
