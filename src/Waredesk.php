<?php

namespace Waredesk;

use GuzzleHttp\HandlerStack;
use Psr\Log\LoggerInterface;

class Waredesk
{
    const PRODUCTION_API_URL = 'https://api.waredesk.com';

    /** @var Variables */
    public $variables;
    /** @var Products */
    public $products;
    /** @var Inventory */
    public $inventory;

    private $logger;
    private $apiUrl;
    private $requestHandler;

    public function __construct(string $clientId, string $clientSecret, string $accessToken = null, LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        $this->apiUrl = self::PRODUCTION_API_URL;
        $this->requestHandler = new RequestHandler($clientId, $clientSecret, $accessToken, $this->apiUrl, $this->logger);
        $this->products = new Products($this->requestHandler);
        $this->variables = new Variables($this->requestHandler);
        $this->categories = new Categories($this->requestHandler);
        $this->inventory = new Inventory($this->requestHandler);
    }

    public function getLogger(): ? LoggerInterface
    {
        return $this->logger;
    }

    public function setLogger(LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        $this->requestHandler->setLogger($logger);
    }

    public function getApiUrl(): ? string
    {
        return $this->apiUrl;
    }

    public function setApiUrl(string $apiUrl)
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
