<?php

namespace Waredesk\Collections\Products\Variants;

use Waredesk\Collection;
use Waredesk\Models\Product\Variant\Code;
use JsonSerializable;

/**
 * @method Code first()
 * @method Code current()
 * @method Code next()
 * @method Code offsetGet($offset)
 */
class Codes extends Collection
{
    /**
     * @param Code|\Waredesk\Models\Code $item
     */
    public function add($item): void
    {
        parent::add($item);
    }

    public function findByCode(string $code): ? Code
    {
        /** @var Code $item */
        foreach ($this->items as $item) {
            if ($item->getCode() === $code) {
                return $item;
            }
        }
        return null;
    }

    public function findByName($name): ? Code
    {
        /** @var Code $item */
        foreach ($this->items as $item) {
            if ($item->getName() === $name) {
                return $item;
            }
        }
        return null;
    }

    public function jsonSerialize(): array
    {
        return array_map(function (JsonSerializable $item) {
            $finalItem = $item->jsonSerialize();
            if (isset($finalItem['id'])) {
                $finalItem = array_merge(['code' => $finalItem['id']], $finalItem);
                unset($finalItem['id']);
                $finalItem = $this->serializeElements($finalItem);
            }
            return $finalItem;
        }, $this->items);
    }

    private function serializeElements(array $item): array
    {
        if (isset($item['elements']) && is_array($item['elements'])) {
            $finalElements = [];
            foreach ($item['elements'] as $element) {
                if (isset($element['id'])) {
                    $element = array_merge(['element' => $element['id']], $element);
                    unset($element['id']);
                }
                $finalElements[] = $element;
            }
            $item['elements'] = $finalElements;
        }
        return $item;
    }
}
