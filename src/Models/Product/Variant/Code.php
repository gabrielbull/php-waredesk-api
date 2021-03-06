<?php

namespace Waredesk\Models\Product\Variant;

use DateTime;
use JsonSerializable;
use Waredesk\Collections\Products\Variants\Codes\Elements;
use Waredesk\Entity;

class Code implements Entity, JsonSerializable
{
    private $id;
    private $type;
    private $custom_type;
    private $value;
    private $creation;
    private $modification;

    public function __construct()
    {
    }

    public function __clone()
    {
    }

    public function getId(): ? string
    {
        return $this->id;
    }

    public function getType(): ? string
    {
        return $this->type;
    }

    public function getCustomType(): ? string
    {
        return $this->custom_type;
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
                    case 'type':
                        $this->type = $value;
                        break;
                    case 'custom_type':
                        $this->custom_type = $value;
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

    public function setType(string $type = null)
    {
        $this->type = $type;
    }

    public function setCustomType(string $custom_type = null)
    {
        $this->custom_type = $custom_type;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function jsonSerialize(): array
    {
        $returnValue = [
            'type' => $this->getType(),
            'custom_type' => $this->getCustomType(),
            'value' => $this->getValue(),
        ];
        if ($this->getId()) {
            $returnValue = array_merge(['id' => $this->getId()], $returnValue);
        }
        return $returnValue;
    }
}
