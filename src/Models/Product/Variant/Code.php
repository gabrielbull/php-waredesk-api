<?php

namespace Waredesk\Models\Product\Variant;

use DateTime;
use JsonSerializable;
use Waredesk\Collections\Products\Variants\Codes\Elements;

class Code implements JsonSerializable
{
    private $id;
    private $name;
    private $elements;
    private $creation;
    private $modification;

    public function __construct()
    {
        $this->elements = new Elements();
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
                    case 'name':
                        $this->name = $value;
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

    public function jsonSerialize()
    {
        return [
            'code' => $this->getId(),
            'elements' => $this->getElements()->jsonSerialize(),
        ];
    }
}
