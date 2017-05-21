<?php

namespace Waredesk;

abstract class Mapper
{
    /**
     * @param Collection $collection
     * @param array $data
     * @param string $entityClass
     * @param string $mapperClass
     * @return Collection|mixed
     */
    protected function create(Collection $collection, array $data, string $entityClass, string $mapperClass)
    {
        $collection->reset();
        foreach ($data as $element) {
            $this->createEntity($element, $collection, $entityClass, $mapperClass);
        }
        return $collection;
    }

    /**
     * @param Collection $collection
     * @param array $data
     * @param string $entityClass
     * @param string $mapperClass
     * @return Collection|mixed
     */
    protected function replace(Collection $collection, array $data, string $entityClass, string $mapperClass)
    {
        $items = $this->getCollectionItems($collection);
        foreach ($data as $element) {
            $items = $this->createOrReplaceEntity($element, $items, $collection, $entityClass, $mapperClass);
        }
        foreach ($items as $id => [$key, $item]) {
            unset($collection[$key]);
        }
        return $collection;
    }

    private function getCollectionItems(Collection $items): array
    {
        $finalItems = [];
        /**
         * @var string $key
         * @var ReplaceableEntity $item
         */
        foreach ($items as $key => $item) {
            $finalItems[$item->getId()] = [$key, $item];
        }
        return $finalItems;
    }

    private function createOrReplaceEntity(
        array $data, array $items, Collection $collection, string $entityClass, string $mapperClass
    ): array
    {
        if (isset($data['id'])) {
            if (isset($items[$data['id']])) {
                /**
                 * @var string $key
                 * @var Entity $item
                 */
                [$key, $item] = $items[$data['id']];
                unset($items[$data['id']]);
                $collection[$key] = (new $mapperClass())->map($item, $data);
                return $items;
            }
        }
        $this->createEntity($data, $collection, $entityClass, $mapperClass);
        return $items;
    }

    private function createEntity(
        array $data, Collection $collection, string $entityClass, string $mapperClass
    )
    {
        /** @var Entity $item */
        $item = new $entityClass();
        $item = (new $mapperClass())->map($item, $data);
        $collection->add($item);
    }
}
