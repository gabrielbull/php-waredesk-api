<?php

namespace Waredesk;

use Waredesk\Mappers\CategoriesMapper;
use Waredesk\Mappers\CategoryMapper;
use Waredesk\Models\Category;

class Categories
{
    private $requestHandler;

    public function __construct(RequestHandler $requestHandler)
    {
        $this->requestHandler = $requestHandler;
    }

    public function create(Category $category): Category
    {
        $response = $this->requestHandler->post(
            '/v1/categories',
            $category
        );
        $category = (new CategoryMapper())->map($category, $response);
        return $category;
    }

    /**
     * @return Collections\Categories|Category[]
     */
    public function fetch(): Collections\Categories
    {
        $response = $this->requestHandler->get('/v1/categories');
        return (new CategoriesMapper())->map(new Collections\Categories(), $response);
    }
}
