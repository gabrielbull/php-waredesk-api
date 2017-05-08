<?php

namespace Waredesk;

use GuzzleHttp\Exception\ClientException;
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

    public function __construct(string $accessToken = null, string $apiUrl = null)
    {
        $this->accessToken = $accessToken;
        $this->apiUrl = $apiUrl;
        $this->client = new Client(['base_uri' => $this->apiUrl, 'handler' => $this->mockHandler]);
    }

    public function getAccessToken(): string
    {
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

    private function handleException(ClientException $exception)
    {
        $this->handleBadResponse($exception->getResponse());
    }

    private function enhanceHeaders(array $headers = []): array
    {
        $headers['Content-Type'] = 'application/json';
        if ($this->accessToken !== null) {
            $headers['Authorization'] = 'Bearer '.$this->accessToken;
        }
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

    private function request(Request $request): array
    {
        try {
            $response = $this->client->send($request);
            if ($response->getStatusCode() >= 200 && $response->getStatusCode() <= 399) {
                return \GuzzleHttp\json_decode((string)$response->getBody(), true);
            }
            $this->handleBadResponse($response);
        } catch (ClientException $e) {
            $this->handleException($e);
        }
        throw new UnknownException();
    }

    public function get(string $endpoint, array $headers = [], array $params = null): array
    {
        return $this->request(
            new GuzzleRequest(
                'GET',
                $endpoint,
                $this->enhanceHeaders($headers),
                $this->encodeParams($params)
            )
        );
    }

    public function post(string $endpoint, $params = null, array $headers = []): array
    {
        return $this->request(
            new GuzzleRequest(
                'POST',
                $endpoint,
                $this->enhanceHeaders($headers),
                $this->encodeParams($params)
            )
        );
    }
}
