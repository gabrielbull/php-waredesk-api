<?php

namespace Waredesk\Tests\Categories;

use GuzzleHttp\Psr7\Response;
use Waredesk\Models\Category;
use Waredesk\Tests\BaseTest;

class GetTest extends BaseTest
{
    public function testFetchCategories()
    {
        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/getTestSuccess.json')));

        $codes = $this->waredesk->categories->fetch();
        $this->assertGreaterThan(0, count($codes));
        $this->assertInstanceOf(Category::class, $codes->first());
    }
}
