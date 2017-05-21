<?php

namespace Waredesk\Collections\Products\Variants;

use Waredesk\Collection;
use Waredesk\Models\Product\Variant\Code;
use JsonSerializable;

/**
 * @method Code first()
 * @method Code current()
 * @method Code next()
 */
class Codes extends Collection
{
    /**
     * @param Code|\Waredesk\Models\Code $item
     */
    public function add($item)
    {
        parent::add($item);
    }

    public function jsonSerialize()
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
