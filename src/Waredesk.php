<?php

namespace Waredesk;

use GuzzleHttp\HandlerStack;

class Waredesk
{
    const PRODUCTION_API_URL = 'https://api.waredesk.com';

    /**
     * @var Codes
     */
    public $codes;

    /**
     * @var Products
     */
    public $products;

    private $apiUrl;
    private $requestHandler;

    public function __construct(string $clientId, string $clientSecret, string $accessToken = null)
    {
        $this->apiUrl = self::PRODUCTION_API_URL;
        $this->requestHandler = new RequestHandler($clientId, $clientSecret, $accessToken, $this->apiUrl);
        $this->products = new Products($this->requestHandler);
        $this->codes = new Codes($this->requestHandler);
        $this->categories = new Categories($this->requestHandler);
    }

    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = rtrim($apiUrl, '/');
        $this->requestHandler->setApiUrl($this->apiUrl);
    }

    public function getClientId(): string
    {
        return $this->requestHandler->getClientId();
    }

    public function setClientId(string $clientId = null)
    {
        $this->requestHandler->setClientId($clientId);
    }

    public function getClientSecret(): string
    {
        return $this->requestHandler->getClientSecret();
    }

    public function setClientSecret(string $clientSecret = null)
    {
        $this->requestHandler->setClientSecret($clientSecret);
    }

    public function getAccessToken(): string
    {
        return $this->requestHandler->getAccessToken();
    }

    public function setAccessToken(string $accessToken = null)
    {
        $this->requestHandler->setAccessToken($accessToken);
    }

    public function setMockHandler(HandlerStack $mockHandler = null)
    {
        $this->requestHandler->setMockHandler($mockHandler);
    }
}
