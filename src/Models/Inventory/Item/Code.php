<?php

namespace Waredesk\Models\Inventory\Item;

use JsonSerializable;
use Waredesk\Entity;

class Code implements Entity, JsonSerializable
{
    private $code;
    private $name;
    private $value;

    public function __construct(array $data = null)
    {
        $this->reset($data);
    }

    public function __clone()
    {
    }

    public function getName(): ? string
    {
        return $this->name;
    }

    public function getValue(): ? string
    {
        return $this->value;
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
                    case 'value':
                        $this->value = $value;
                        break;
                }
            }
        }
    }

    public function setCode(string $code)
    {
        $this->code = $code;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function jsonSerialize(): array
    {
        $returnValue = [
            'code' => $this->getName(),
            'value' => $this->getValue(),
        ];
        return $returnValue;
    }
}
