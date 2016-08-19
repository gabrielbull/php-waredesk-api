<?php

namespace Waredesk;

class Waredesk
{
    const PRODUCTION_API_URL = 'https://api.waredesk.com';

    /**
     * @var Products
     */
    public $products;

    private $apiUrl;
    private $requestHandler;
    private $clientId;
    private $clientSecret;
    private $accessToken;

    public function __construct(string $clientId, string $clientSecret, string $accessToken = null)
    {
        $this->apiUrl = self::PRODUCTION_API_URL;
        $this->requestHandler = new RequestHandler($accessToken, $this->apiUrl);
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->accessToken = $accessToken;
        $this->products = new Products();
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

    public function getAccessToken(): string
    {
        if (null !== $this->accessToken) {
            return $this->accessToken;
        }
        $response = $this->requestHandler->post(
            '/v1/authorize',
            [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type' => 'client_credentials'
            ]
        );
        $this->accessToken = $response['access_token'];
        $this->requestHandler->setAccessToken($this->accessToken);
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->requestHandler->setAccessToken($this->accessToken);
    }
}
