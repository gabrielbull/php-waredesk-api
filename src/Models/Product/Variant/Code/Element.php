<?php

namespace Waredesk\Models\Product\Variant\Code;

use JsonSerializable;

class Element implements JsonSerializable
{
    private $id;
    private $type;
    private $value;
    private $auto_increment;

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
