<?php

namespace Waredesk\Models\Product\Variant;

use DateTime;

class Code
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

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function getCreationDatetime(): ?DateTime
    {
        return $this->creation_datetime;
    }

    public function setCreationDatetime(DateTime $creation_datetime)
    {
        $this->creation_datetime = $creation_datetime;
    }

    public function getModificationDatetime(): ?DateTime
    {
        return $this->modification_datetime;
    }

    public function setModificationDatetime(DateTime $modification_datetime)
    {
        $this->modification_datetime = $modification_datetime;
    }
}
