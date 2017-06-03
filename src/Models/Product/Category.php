<?php

namespace Waredesk\Models\Product;

use JsonSerializable;
use Waredesk\Entity;
use Waredesk\ReplaceableEntity;

class Category implements Entity, ReplaceableEntity, JsonSerializable
{
    private $id;
    private $name;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function __clone()
    {
    }

    public function getId(): ? string
    {
        return $this->id;
    }

    public function getName(): ? string
    {
        return $this->name;
    }

    public function reset(array $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                switch ($key) {
                    case 'id':
                        $this->id = $value;
                        break;
                    case 'name':
                        $this->name = $value;
                        break;
                }
            }
        }
    }

    public function jsonSerialize(): string
    {
        return $this->getId();
    }
}
