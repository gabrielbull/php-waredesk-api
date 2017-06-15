<?php

namespace Waredesk;

use Waredesk\Exceptions\CannotUpdateNewEntityException;

abstract class Controller
{
    protected const ORDER_BY_ASC = 'ASC';
    protected const ORDER_BY_DESC = 'DESC';

    protected $requestHandler;

    public function __construct(RequestHandler $requestHandler)
    {
        $this->requestHandler = $requestHandler;
    }

    protected function validateIsNotNewEntity(string $id)
    {
        if (!$id) {
            throw new CannotUpdateNewEntityException();
        }
    }

    protected function doCreate(string $path, $entity, callable $mappingFunction)
    {
        return $mappingFunction($this->requestHandler->post(
            $path,
            $entity
        ));
    }

    protected function doUpdate(string $path, $entity, callable $mappingFunction)
    {
        return $mappingFunction($this->requestHandler->update(
            $path,
            $entity
        ));
    }

    protected function doDelete(string $path)
    {
        $this->requestHandler->delete($path);
        return true;
    }

    protected function doFetch(string $path, callable $mappingFunction)
    {
        return $mappingFunction($this->requestHandler->get($path));
    }

    protected function doFetchOne(string $path, string $orderBy = null, string $order = self::ORDER_BY_ASC, callable $mappingFunction)
    {
        $response = $this->requestHandler->get($path, [
            'order_by' => $orderBy,
            'order' => $order,
            'limit' => 1
        ]);
        /** @var Collection $items */
        $items = $mappingFunction($response);
        if (count($items)) {
            return $items->first();
        }
        return null;
    }
}
