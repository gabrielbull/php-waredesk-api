<?php

namespace Waredesk\Models\Product\Variant;

use DateTime;
use JsonSerializable;
use Waredesk\Entity;
use Waredesk\ReplaceableEntity;

class Annotation implements Entity, ReplaceableEntity, JsonSerializable
{
    private $id;
    private $label;
    private $value;
    private $creation;
    private $modification;

    public function getId(): ? string
    {
        return $this->id;
    }

    public function getLabel(): ? string
    {
        return $this->label;
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
                    case 'label':
                        $this->label = $value;
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

    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function jsonSerialize()
    {
        return [
            'label' => $this->getLabel(),
            'value' => $this->getValue(),
        ];
    }
}
