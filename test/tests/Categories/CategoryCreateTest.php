<?php

namespace Waredesk\Tests\Categories;

use GuzzleHttp\Psr7\Response;
use Waredesk\Models\Category;
use Waredesk\Tests\BaseTest;

class CategoryCreateTest extends BaseTest
{
    private function createCategory(): Category
    {
        $category = new Category();
        $category->setName('Women');
        return $category;
    }

    public function testCreateCategory()
    {
        $category = $this->createCategory();

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/../../files/categories/createTestSuccess.json')));

        $category = $this->waredesk->categories->create($category);
        $this->assertNotEmpty($category->getId());
        $this->assertEquals('Women', $category->getName());
    }
}
