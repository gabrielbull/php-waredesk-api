<?php

namespace Waredesk\Models;

use DateTime;
use Waredesk\Collections\Products\Variants;

class Product
{
    private $id;
    private $images;
    private $variants;
    private $name;
    private $description;
    private $notes;
    private $creation_datetime;
    private $modification_datetime;

    public function __construct()
    {
        $this->variants = new Variants();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(array $images)
    {
        $this->images = $images;
    }

    public function getVariants(): ?Variants
    {
        return $this->variants;
    }

    public function setVariants(Variants $variants)
    {
        $this->variants = $variants;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes)
    {
        $this->notes = $notes;
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
