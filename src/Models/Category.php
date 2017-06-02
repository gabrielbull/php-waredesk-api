<?php

namespace Waredesk\Models;

use DateTime;
use JsonSerializable;
use Waredesk\Entity;
use Waredesk\ReplaceableEntity;

class Category implements Entity, ReplaceableEntity, JsonSerializable
{
    private $id;
    private $parent;
    private $name;
    private $creation;
    private $modification;

    public function __construct(array $data = null)
    {
        $this->reset($data);
    }

    public function __clone()
    {
    }

    public function getId(): ? string
    {
        return $this->id;
    }

    public function getParent(): ? string
    {
        return $this->parent;
    }

    public function getName(): ? string
    {
        return $this->name;
    }

    public function getCreation(): ?DateTime
    {
        return $this->creation;
    }

    public function getModification(): ? DateTime
    {
        return $this->modification;
    }

    public function reset(array $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                switch ($key) {
                    case 'id':
                        $this->id = $value;
                        break;
                    case 'parent':
                        $this->parent = $value;
                        break;
                    case 'name':
                        $this->name = $value;
                        break;
                    case 'creation':
                        $this->creation = $value;
                        break;
                    case 'modification':
                        $this->modification = $value;
                        break;
                }
            }
        }
    }

    public function setParent(string $parent = null)
    {
        $this->parent = $parent;
    }

    public function setName(string $name = null)
    {
        $this->name = $name;
    }

    public function jsonSerialize(): array
    {
        $returnValue = [
            'parent' => $this->getParent(),
            'name' => $this->getName(),
        ];
        if ($this->getId()) {
            $returnValue = array_merge(['id' => $this->getId()], $returnValue);
        }
        return $returnValue;
    }
}
