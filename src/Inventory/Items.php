<?php

namespace Waredesk\Inventory;

use Waredesk\Controller;
use Waredesk\Mappers\Inventory\ItemMapper;
use Waredesk\Mappers\Inventory\ItemsMapper;
use Waredesk\Models\Inventory\Item;
use Waredesk\Collections;

class Items extends Controller
{
    private const ENDPOINT = '/v1-alpha/inventory/items';

    public function create(Item $item): Item
    {
        return $this->doCreate(
            self::ENDPOINT,
            $item,
            function ($response) use ($item) {
                return (new ItemMapper())->map($item, $response);
            }
        );
    }

    public function delete(Item $item): bool
    {
        $this->validateIsNotNewEntity($item->getId());
        return $this->doDelete(self::ENDPOINT."/{$item->getId()}");
    }

    public function fetch(string $orderBy = null, string $order = self::ORDER_BY_ASC, int $limit = null): Collections\Inventory\Items
    {
        return $this->doFetch(
            self::ENDPOINT,
            $orderBy,
            $order,
            $limit,
            function ($response) {
                return (new ItemsMapper())->map(new Collections\Inventory\Items(), $response);
            }
        );
    }

    public function fetchOne(string $orderBy = null, string $order = self::ORDER_BY_ASC): ? Item
    {
        return $this->doFetchOne(
            self::ENDPOINT,
            $orderBy,
            $order,
            function ($response) {
                return (new ItemsMapper())->map(new Collections\Inventory\Items(), $response);
            }
        );
    }

    public function findOneBy(array $criteria, string $orderBy = null, string $order = self::ORDER_BY_ASC): ? Item
    {
        return $this->doFindOneBy(
            self::ENDPOINT,
            $criteria,
            $orderBy,
            $order,
            function ($response) {
                return (new ItemsMapper())->map(new Collections\Inventory\Items(), $response);
            }
        );
    }
}
