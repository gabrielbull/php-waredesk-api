<?php

namespace Waredesk;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Waredesk\Exceptions\UnknownException;

class RequestHandler
{
    private $accessToken;
    private $apiUrl;
    private $client;

    public function __construct(string $accessToken = null, string $apiUrl = null)
    {
        $this->accessToken = $accessToken;
        $this->apiUrl = $apiUrl;
        $this->client = new Client(['base_uri' => $this->apiUrl . '/']);
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken)
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
        $this->client = new Client(['base_uri' => $apiUrl . '/']);
    }

    private function handleBadResponse(ResponseInterface $response)
    {
        $body = (string) $response->getBody();
        $json = \GuzzleHttp\json_decode($body, true);
        ErrorHandler::error($json);
    }

    private function handleException(ClientException $exception)
    {
        $this->handleBadResponse($exception->getResponse());
    }

    public function get(string $endpoint, array $headers = [], array $params = null)
    {
    }

    public function post(string $endpoint, array $params = null, array $headers = []): array
    {
        $headers['Content-Type'] = 'application/json';
        $body = null;
        if ($params) $body = \GuzzleHttp\json_encode($params);
        $request = new GuzzleRequest('POST', $endpoint, $headers, $body);

        try {
            $response = $this->client->send($request);
            if ($response->getStatusCode() >= 200 && $response->getStatusCode() <= 399) {
                return \GuzzleHttp\json_decode((string)$response->getBody(), true);
            } else {
                $this->handleBadResponse($response);
            }
        } catch (ClientException $e) {
            $this->handleException($e);
        }
        throw new UnknownException();
    }
}
