<?php

namespace Waredesk\Models\Product\Variant\Code;

use JsonSerializable;
use Waredesk\Entity;

class Element implements Entity, JsonSerializable
{
    private $element;
    private $type;
    private $value;
    private $auto_increment;
    private $pad_direction;
    private $pad_char;
    private $pad_length;

    public function getElement(): ? string
    {
        return $this->element;
    }

    public function getType(): ? string
    {
        return $this->type;
    }

    public function getValue(): ? string
    {
        return $this->value;
    }

    public function getAutoIncrement(): ? bool
    {
        return $this->auto_increment;
    }

    public function getPadDirection(): ? string
    {
        return $this->pad_direction;
    }

    public function getPadChar(): ? string
    {
        return $this->pad_char;
    }

    public function getPadLength(): ? int
    {
        return $this->pad_length;
    }

    public function reset(array $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                switch ($key) {
                    case 'element':
                        $this->element = $value;
                        break;
                    case 'type':
                        $this->type = $value;
                        break;
                    case 'value':
                        $this->value = $value;
                        break;
                    case 'auto_increment':
                        $this->auto_increment = $value;
                        break;
                    case 'pad_direction':
                        $this->pad_direction = $value;
                        break;
                    case 'pad_char':
                        $this->pad_char = $value;
                        break;
                    case 'pad_length':
                        $this->pad_length = $value;
                        break;
                }
            }
        }
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function setAutoIncrement(bool $auto_increment = null)
    {
        $this->auto_increment = $auto_increment;
    }

    public function setPadDirection(string $pad_direction = null)
    {
        $this->pad_direction = $pad_direction;
    }

    public function setPadChar(string $pad_char = null)
    {
        $this->pad_char = $pad_char;
    }

    public function setPadLength(int $pad_length = null)
    {
        $this->pad_length = $pad_length;
    }

    public function jsonSerialize()
    {
        return [
            'element' => $this->getElement(),
            'value' => $this->getValue(),
            'auto_increment' => $this->getAutoIncrement(),
            'pad_direction' => $this->getPadDirection(),
            'pad_char' => $this->getPadChar(),
            'pad_length' => $this->getPadLength(),
        ];
    }
}
