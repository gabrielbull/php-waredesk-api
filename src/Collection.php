<?php

namespace Waredesk;

use Iterator;
use Countable;
use JsonSerializable;

abstract class Collection implements Iterator, Countable, JsonSerializable
{
    protected $items;
    protected $key;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function replace(array $items = [])
    {
        $this->items = $items;
    }

    public function add($item)
    {
        $this->items[] = $item;
    }

    public function first()
    {
        return isset($this->items[0]) ? $this->items[0] : null;
    }

    public function jsonSerialize()
    {
        return array_map(function (JsonSerializable $item) {
            return $item->jsonSerialize();
        }, $this->items);
    }

    public function count()
    {
        return count($this->items);
    }

    public function current()
    {
        return current($this->items);
    }

    public function next()
    {
        return next($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function valid()
    {
        $key = key($this->items);
        return ($key !== null && $key !== false);
    }

    public function rewind()
    {
        reset($this->items);
    }
}
