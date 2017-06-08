<?php

namespace Waredesk\Models\Inventory\Item;

use JsonSerializable;
use Waredesk\Entity;
use DateTime;

class Activity implements Entity, JsonSerializable
{
    private $id;
    private $type;
    private $note;
    private $date;
    private $creation;
    private $modification;

    public function __construct(array $data = null)
    {
        $this->reset($data);
    }

    public function __clone()
    {
    }

    public function getId(): ? string
    {
        return $this->id;
    }

    public function getType(): ? string
    {
        return $this->type;
    }

    public function getNote(): ? string
    {
        return $this->note;
    }

    public function getDate(): ? DateTime
    {
        return $this->date;
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
                    case 'type':
                        $this->type = $value;
                        break;
                    case 'note':
                        $this->note = $value;
                        break;
                    case 'date':
                        $this->date = $value;
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

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function setNote(string $note)
    {
        $this->note = $note;
    }

    public function setDate(DateTime $date)
    {
        $this->date = $date;
    }

    public function jsonSerialize(): array
    {
        $returnValue = [
            'type' => $this->getType(),
            'note' => $this->getNote(),
            'date' => $this->getDate()->format(DateTime::ATOM),
        ];
        return $returnValue;
    }
}
