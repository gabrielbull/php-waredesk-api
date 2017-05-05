<?php

namespace Waredesk;

use Iterator;
use Countable;

class Collection implements Iterator, Countable
{
    protected $items;
    protected $key;

    public function __construct(array $items = [])
    {
        $this->items = $items;
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
