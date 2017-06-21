<?php

namespace Waredesk\Tests\Categories;

use GuzzleHttp\Psr7\Response;
use Waredesk\Models\Category;
use Waredesk\Tests\BaseTest;

class CategoryFetchTest extends BaseTest
{
    public function testFetchCategories()
    {
        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/../../files/categories/getTestSuccess.json')));

        $categories = $this->waredesk->categories->fetch();
        $this->assertGreaterThan(0, count($categories));
        $this->assertInstanceOf(Category::class, $categories->first());
    }
}
