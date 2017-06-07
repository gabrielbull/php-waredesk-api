<?php

namespace Waredesk\Models\Product\Variant;

use DateTime;
use JsonSerializable;
use Waredesk\Collections\Products\Variants\Codes\Elements;
use Waredesk\Entity;

class Code implements Entity, JsonSerializable
{
    private $code;
    private $name;
    private $quantity;
    private $elements;
    private $creation;
    private $modification;

    public function __construct()
    {
        $this->elements = new Elements();
    }

    public function __clone()
    {
        $this->elements = clone $this->elements;
    }

    public function getCode(): ? string
    {
        return $this->code;
    }

    public function getName(): ? string
    {
        return $this->name;
    }

    public function getQuantity(): ? int
    {
        return $this->quantity;
    }

    public function getElements(): ? Elements
    {
        return $this->elements;
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
                    case 'code':
                        $this->code = $value;
                        break;
                    case 'name':
                        $this->name = $value;
                        break;
                    case 'quantity':
                        $this->quantity = $value;
                        break;
                    case 'elements':
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

    public function setCode(string $code)
    {
        $this->code = $code;
    }

    public function setQuantity(int $quantity = null)
    {
        $this->quantity = $quantity;
    }

    public function jsonSerialize(): array
    {
        return [
            'code' => $this->getCode(),
            'quantity' => $this->getQuantity(),
            'elements' => $this->getElements()->jsonSerialize(),
        ];
    }
}
