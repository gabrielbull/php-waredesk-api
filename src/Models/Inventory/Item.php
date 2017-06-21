<?php

namespace Waredesk\Models\Inventory;

use DateTime;
use JsonSerializable;
use Waredesk\Collections\Inventory\Items\Activities;
use Waredesk\Collections\Inventory\Items\Attributes;
use Waredesk\Collections\Inventory\Items\Codes;
use Waredesk\Entity;
use Waredesk\ReplaceableEntity;

class Item implements Entity, ReplaceableEntity, JsonSerializable
{
    private $id;
    private $warehouse;
    private $product;
    private $variant;
    private $activities;
    private $attributes;
    private $in_stock = true;
    private $note;
    private $creation;
    private $modification;

    public function __construct(array $data = null)
    {
        $this->activities = new Activities();
        $this->attributes = new Attributes();
        $this->reset($data);
    }

    public function __clone()
    {
        $this->activities = clone $this->activities;
        $this->attributes = clone $this->attributes;
    }

    public function getId(): ? string
    {
        return $this->id;
    }

    public function getWarehouse(): ? string
    {
        return $this->warehouse;
    }

    public function getProduct(): ? string
    {
        return $this->product;
    }

    public function getVariant(): ? string
    {
        return $this->variant;
    }

    public function getActivities(): Activities
    {
        return $this->activities;
    }

    public function getAttributes(): Attributes
    {
        return $this->attributes;
    }

    public function isInStock(): ? bool
    {
        return $this->in_stock;
    }

    public function getNote(): ? string
    {
        return $this->note;
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
                    case 'warehouse':
                        $this->warehouse = $value;
                        break;
                    case 'product':
                        $this->product = $value;
                        break;
                    case 'variant':
                        $this->variant = $value;
                        break;
                    case 'activities':
                        $this->activities = $value;
                        break;
                    case 'attributes':
                        $this->attributes = $value;
                        break;
                    case 'in_stock':
                        $this->in_stock = $value;
                        break;
                    case 'note':
                        $this->note = $value;
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

    public function setWarehouse(string $warehouse = null)
    {
        $this->warehouse = $warehouse;
    }

    public function setVariant(string $variant)
    {
        $this->variant = $variant;
    }

    public function setIsInStock(string $in_stock)
    {
        $this->in_stock = $in_stock;
    }

    public function setNote(string $note = null)
    {
        $this->note = $note;
    }

    public function jsonSerialize(): array
    {
        $returnValue = [
            'warehouse' => $this->getWarehouse(),
            'variant' => $this->getVariant(),
            'activities' => $this->getActivities()->jsonSerialize(),
            'attributes' => $this->getAttributes()->jsonSerialize(),
            'in_stock' => $this->isInStock(),
            'note' => $this->getNote(),
        ];
        if ($this->getId()) {
            $returnValue = array_merge(['id' => $this->getId()], $returnValue);
        }
        return $returnValue;
    }
}
