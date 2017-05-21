<?php

namespace Waredesk;

use Iterator;
use Countable;
use JsonSerializable;
use ArrayAccess;

abstract class Collection implements Iterator, Countable, ArrayAccess, JsonSerializable
{
    protected $items;
    protected $key;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function __clone()
    {
        foreach ($this->items as $key => $item) {
            $this->items[$key] = clone $item;
        }
    }

    public function reset()
    {
        $this->items = [];
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

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->items);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->items[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }
}
