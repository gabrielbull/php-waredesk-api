<?php

namespace Waredesk\Tests;

use GuzzleHttp\Psr7\Response;
use Psr\Log\LoggerInterface;
use Waredesk\Exceptions\InvalidClientException;

class Logger implements LoggerInterface
{
    /** @var callable */
    public $callback;
    public function emergency($message, array $context = array()) {}
    public function alert($message, array $context = array()) {}
    public function critical($message, array $context = array()) {}
    public function error($message, array $context = array()) {}
    public function warning($message, array $context = array()) {}
    public function notice($message, array $context = array()) {}
    public function info($message, array $context = array()) {}
    public function debug($message, array $context = array()) {($this->callback)($message, $context);}
    public function log($level, $message, array $context = array()) {}
}

class LoggerTest extends BaseTest
{
    public function testLogging()
    {
        $logger = new Logger();
        $results = [];
        $logger->callback = function ($message, array $context) use (&$results) {
            $results[] = [
                'message' => $message,
                'context' => $context,
            ];
        };
        $this->waredesk->setLogger($logger);
        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/../files/products/getTestSuccess.json')));
        $this->waredesk->products->fetch();

        $results = array_slice($results, count($results)-2, 2);
        $this->assertEquals('REQUEST', $results[0]['message']);
        $this->assertEquals('RESPONSE', $results[1]['message']);
    }
}
