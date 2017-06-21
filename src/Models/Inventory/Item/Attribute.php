<?php

namespace Waredesk\Models\Inventory\Item;

use DateTime;
use JsonSerializable;
use Waredesk\Entity;

class Attribute implements Entity, JsonSerializable
{
    private $id;
    private $item_attribute;
    private $name;
    private $value;
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

    public function getItemAttribute(): ? string
    {
        return $this->item_attribute;
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
                    case 'item_attribute':
                        $this->item_attribute = $value;
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

    public function setItemAttribute(string $item_attribute)
    {
        $this->item_attribute = $item_attribute;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function jsonSerialize(): array
    {
        $returnValue = [
            'item_attribute' => $this->getItemAttribute(),
            'value' => $this->getValue(),
        ];
        return $returnValue;
    }
}
