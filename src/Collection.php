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

    public function reset(): void
    {
        $this->items = [];
    }

    public function replace(array $items = []): void
    {
        $this->items = $items;
    }

    public function add($item): void
    {
        $this->items[] = $item;
    }

    public function first()
    {
        return isset($this->items[0]) ? $this->items[0] : null;
    }

    public function toArray(): array
    {
        return $this->items;
    }

    public function jsonSerialize(): array
    {
        return array_map(function (JsonSerializable $item) {
            return $item->jsonSerialize();
        }, $this->items);
    }

    public function count(): int
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

    public function key(): int
    {
        return key($this->items);
    }

    public function valid(): bool
    {
        $key = key($this->items);
        return ($key !== null && $key !== false);
    }

    public function rewind(): void
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

    public function offsetSet($offset, $value): void
    {
        $this->items[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }
}
