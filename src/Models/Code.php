<?php

namespace Waredesk\Models;

use DateTime;
use Waredesk\Collections\Codes\Elements;
use JsonSerializable;
use Waredesk\Entity;
use Waredesk\ReplaceableEntity;
use Waredesk\Models\Product\Variant\Code as VariantCode;

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

    public function toVariantCode(): VariantCode
    {
        $code = new VariantCode();
        $code->reset([
            'code' => $this->getId(),
            'name' => $this->getName(),
            'creation' => $this->getCreation(),
            'modification' => $this->getModification(),
        ]);
        foreach ($this->getElements() as $element) {
            $nextElement = new VariantCode\Element();
            $nextElement->reset([
                'element' => $element->getId(),
                'type' => $element->getType(),
                'value' => $element->getValue(),
                'auto_increment' => $element->getAutoIncrement(),
                'pad_direction' => $element->getPadDirection(),
                'pad_char' => $element->getPadChar(),
                'pad_length' => $element->getPadLength(),
            ]);
            $code->getElements()->add($nextElement);
        }
        return $code;
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
