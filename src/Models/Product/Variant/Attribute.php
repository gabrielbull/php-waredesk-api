<?php

namespace Waredesk\Models\Product\Variant;

use DateTime;
use JsonSerializable;
use Waredesk\Entity;
use Waredesk\ReplaceableEntity;

class Attribute implements Entity, ReplaceableEntity, JsonSerializable
{
    private $id;
    private $name;
    private $value;
    private $creation;
    private $modification;

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

    public function getValue(): ? string
    {
        return $this->value;
    }

    public function getCreation(): ? DateTime
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
                    case 'name':
                        $this->name = $value;
                        break;
                    case 'value':
                        $this->value = $value;
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

    public function setName(string $label)
    {
        $this->name = $label;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function jsonSerialize(): array
    {
        $returnValue = [
            'name' => $this->getName(),
            'value' => $this->getValue(),
        ];
        if ($this->getId()) {
            $returnValue = array_merge(['id' => $this->getId()], $returnValue);
        }
        return $returnValue;
    }
}
