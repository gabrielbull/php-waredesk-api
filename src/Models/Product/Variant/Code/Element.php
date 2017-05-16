<?php

namespace Waredesk\Models\Product\Variant\Code;

use JsonSerializable;

class Element implements JsonSerializable
{
    private $id;
    private $type;
    private $value;
    private $auto_increment;
    private $pad_direction;
    private $pad_char;
    private $pad_length;

    public function getId(): ? string
    {
        return $this->id;
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
                    case 'id':
                        $this->id = $value;
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

    public function jsonSerialize()
    {
        return [
            'element' => $this->getId(),
            'value' => $this->getValue(),
        ];
    }
}
