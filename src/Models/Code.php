<?php

namespace Waredesk\Models;

use DateTime;
use Waredesk\Collections\Codes\Elements;
use JsonSerializable;
use Waredesk\Entity;
use Waredesk\ReplaceableEntity;

class Code implements Entity, ReplaceableEntity, JsonSerializable
{
    private $id;
    private $name;
    private $elements;
    private $creation;
    private $modification;

    public function __construct(array $data = null)
    {
        $this->elements = new Elements();
        $this->reset($data);
    }

    public function __clone()
    {
        $this->elements = clone $this->elements;
    }

    public function getId(): ? string
    {
        return $this->id;
    }

    public function getName(): ? string
    {
        return $this->name;
    }

    public function getElements(): ? Elements
    {
        return $this->elements;
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
                    case 'name':
                        $this->name = $value;
                        break;
                    case 'variants':
                        $this->elements = $value;
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

    public function setName(string $name = null)
    {
        $this->name = $name;
    }

    public function jsonSerialize(): array
    {
        $returnValue = [
            'name' => $this->getName(),
            'elements' => $this->getElements()->jsonSerialize(),
        ];
        if ($this->getId()) {
            $returnValue = array_merge(['id' => $this->getId()], $returnValue);
        }
        return $returnValue;
    }
}
