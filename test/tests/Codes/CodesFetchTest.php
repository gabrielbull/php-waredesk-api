<?php

namespace Waredesk\Tests\Codes;

use GuzzleHttp\Psr7\Response;
use Waredesk\Models\Code;
use Waredesk\Tests\BaseTest;

class CodesFetchTest extends BaseTest
{
    public function testFetchCodes()
    {
        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/getTestSuccess.json')));

        $codes = $this->waredesk->codes->fetch();
        $this->assertGreaterThan(0, count($codes));
        $this->assertInstanceOf(Code::class, $codes->first());
    }
}
