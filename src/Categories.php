<?php

namespace Waredesk;

use Waredesk\Mappers\CategoriesMapper;
use Waredesk\Mappers\CategoryMapper;
use Waredesk\Models\Category;

class Categories extends Controller
{
    private const ENDPOINT = '/v1-alpha/categories';

    public function create(Category $category): Category
    {
        return $this->doCreate(
            self::ENDPOINT,
            $category,
            function ($response) use ($category) {
                return (new CategoryMapper())->map($category, $response);
            }
        );
    }

    public function delete(Category $category): bool
    {
        $this->validateIsNotNewEntity($category->getId());
        return $this->doDelete(self::ENDPOINT."/{$category->getId()}");
    }

    public function fetch(string $orderBy = null, string $order = self::ORDER_BY_ASC, int $limit = null): Collections\Categories
    {
        return $this->doFetch(
            self::ENDPOINT,
            $orderBy,
            $order,
            $limit,
            function ($response) {
                return (new CategoriesMapper())->map(new Collections\Categories(), $response);
            }
        );
    }

    public function fetchOne(string $orderBy = null, string $order = self::ORDER_BY_ASC): ? Category
    {
        return $this->doFetchOne(
            self::ENDPOINT,
            $orderBy,
            $order,
            function ($response) {
                return (new CategoriesMapper())->map(new Collections\Categories(), $response);
            }
        );
    }

    public function findOneBy(array $criteria, string $orderBy = null, string $order = self::ORDER_BY_ASC): ? Category
    {
        return $this->doFindOneBy(
            self::ENDPOINT,
            $criteria,
            $orderBy,
            $order,
            function ($response) {
                return (new CategoriesMapper())->map(new Collections\Categories(), $response);
            }
        );
    }
}
