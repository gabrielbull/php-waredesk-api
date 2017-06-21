<?php

namespace Waredesk\Tests;

use GuzzleHttp\Psr7\Response;
use Waredesk\Models\Category;

class CategoriesController
{
    /**
     * @var BaseTest
     */
    protected $baseTest;

    public function __construct(BaseTest $baseTest)
    {
        $this->baseTest = $baseTest;
    }

    private function response($name, $parent = null)
    {
        $category = json_decode(file_get_contents(__DIR__ . '/../files/categories/category.json'), true);
        $category['name'] = $name;
        $category['parent'] = $parent;
        return json_encode($category);
    }

    private function responseArray($name, $parent = null)
    {
        return json_encode([json_decode($this->response($name, $parent), true)]);
    }

    public function getMenCategory(): Category
    {
        $this->baseTest->mock->append(new Response(200, [], $this->responseArray('Men')));
        $category = $this->baseTest->waredesk->categories->findOneBy(['name' => 'Men']);
        if ($category && !$this->validateMenCategory($category)) {
            $this->deleteCategory($category);
            $category = null;
        }
        if (!$category) {
            $category = $this->createCategory('Men');
        }
        return $category;
    }

    public function getUnderwearCategory(): Category
    {
        $parent = $this->getMenCategory();
        $this->baseTest->mock->append(new Response(200, [], $this->responseArray('Underwear', $parent->getId())));
        $category = $this->baseTest->waredesk->categories->findOneBy(['name' => 'Underwear']);
        if ($category && !$this->validateUnderwearCategory($category, $parent)) {
            $this->deleteCategory($category);
            $category = null;
        }
        if (!$category) {
            $category = $this->createCategory('Underwear', $parent->getId());
        }
        return $category;
    }

    private function createCategory($name, $parent = null): Category
    {
        $category = new Category();
        $category->setName($name);
        $category->setParent($parent);
        $this->baseTest->mock->append(new Response(200, [], $this->response($name, $parent)));
        $category = $this->baseTest->waredesk->categories->create($category);
        return $category;
    }

    private function deleteCategory(Category $category)
    {
        $this->baseTest->mock->append(new Response(200, [], 'true'));
        $this->baseTest->waredesk->categories->delete($category);
    }

    public function validateMenCategory(Category $category): bool
    {
        if ($category->getParent() !== null) {
            return false;
        } elseif ($category->getName() !== 'Men') {
            return false;
        }
        return true;
    }

    public function validateUnderwearCategory(Category $category, Category $parent): bool
    {
        if ($category->getParent() !== $parent->getId()) {
            return false;
        } elseif ($category->getName() !== 'Underwear') {
            return false;
        }
        return true;
    }
}
