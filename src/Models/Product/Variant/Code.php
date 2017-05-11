<?php

namespace Waredesk\Models\Product\Variant;

use DateTime;
use JsonSerializable;

class Code implements JsonSerializable
{
    private $id;
    private $label;
    private $value;
    private $creation_datetime;
    private $modification_datetime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getCreationDatetime(): ?DateTime
    {
        return $this->creation_datetime;
    }

    public function getModificationDatetime(): ?DateTime
    {
        return $this->modification_datetime;
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
                    case 'creation_datetime':
                        $this->creation_datetime = $value;
                        break;
                    case 'modification_datetime':
                        $this->modification_datetime = $value;
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
