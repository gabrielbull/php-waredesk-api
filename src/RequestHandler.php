<?php

namespace Waredesk;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use Waredesk\Exceptions\UnknownException;

class RequestHandler
{
    private $mockHandler;
    private $accessToken;
    private $apiUrl;
    private $client;
    private $clientId;
    private $clientSecret;
    private $disabledAuthentication = false;

    public function __construct(string $clientId, string $clientSecret, string $accessToken = null, string $apiUrl = null)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->accessToken = $accessToken;
        $this->apiUrl = $apiUrl;
        $this->client = new Client(['base_uri' => $this->apiUrl, 'handler' => $this->mockHandler]);
    }

    public function disabledAuthentication()
    {
        $this->disabledAuthentication = true;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function setClientId(string $clientId = null)
    {
        $this->clientId = $clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function setClientSecret(string $clientSecret = null)
    {
        $this->clientSecret = $clientSecret;
    }

    public function getAccessToken(): string
    {
        if (null !== $this->accessToken) {
            return $this->accessToken;
        }
        $this->disabledAuthentication();
        $response = $this->post(
            '/v1-alpha/authorize',
            [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type' => 'client_credentials'
            ]
        );
        $this->accessToken = $response['access_token'];
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken = null)
    {
        $this->accessToken = $accessToken;
    }

    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    public function setApiUrl(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
        $this->client = new Client(['base_uri' => $this->apiUrl, 'handler' => $this->mockHandler]);
    }

    public function setMockHandler(HandlerStack $mockHandler = null)
    {
        $this->mockHandler = $mockHandler;
        $this->client = new Client(['base_uri' => $this->apiUrl, 'handler' => $this->mockHandler]);
    }

    private function handleBadResponse(ResponseInterface $response = null)
    {
        if ($response) {
            $body = (string)$response->getBody();
            $json = \GuzzleHttp\json_decode($body, true);
            (new ErrorHandler())($json);
            return;
        }
        throw new UnknownException();
    }

    private function handleException(BadResponseException $exception)
    {
        $this->handleBadResponse($exception->getResponse());
    }

    private function enhanceHeaders(array $headers = []): array
    {
        $headers['Content-Type'] = 'application/json';
        if (!$this->disabledAuthentication) {
            $accessToken = $this->getAccessToken();
            if ($accessToken !== null) {
                $headers['Authorization'] = 'Bearer '.$accessToken;
            }
        }
        $this->disabledAuthentication = false;
        return $headers;
    }

    private function encodeParams($params = null): ?string
    {
        $body = null;
        if ($params) {
            $body = \GuzzleHttp\json_encode($params);
        }
        return $body;
    }

    private function request(string $method, string $endpoint, array $headers = [], $params = null)
    {
        try {
            $request = new GuzzleRequest(
                $method,
                $endpoint,
                $this->enhanceHeaders($headers),
                $this->encodeParams($params)
            );
            $response = $this->client->send($request);
            if ($response->getStatusCode() >= 200 && $response->getStatusCode() <= 399) {
                /*if ($endpoint !== '/v1/authorize' && $method !== 'GET') {
                    echo $method.PHP_EOL;
                    echo $endpoint.PHP_EOL;
                    $body = (string)$response->getBody();
                    //$obj = \GuzzleHttp\json_decode($body);
                    echo $body;
                    die();
                }*/
                return \GuzzleHttp\json_decode((string)$response->getBody(), true);
            }
            $this->handleBadResponse($response);
        } catch (BadResponseException $e) {
            /*$body = (string)$e->getResponse()->getBody();
            echo $body;
            die();*/
            $this->handleException($e);
        }
        throw new UnknownException();
    }

    public function get(string $endpoint, $params = null, array $headers = []): array
    {
        return $this->request('GET', $endpoint, $headers, $params);
    }

    public function post(string $endpoint, $params = null, array $headers = []): array
    {
        return $this->request('POST', $endpoint, $headers, $params);
    }

    public function update(string $endpoint, $params = null, array $headers = []): array
    {
        return $this->request('PUT', $endpoint, $headers, $params);
    }

    public function delete(string $endpoint, $params = null, array $headers = []): bool
    {
        return $this->request('DELETE', $endpoint, $headers, $params);
    }
}
