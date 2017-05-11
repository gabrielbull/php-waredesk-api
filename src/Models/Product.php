<?php

namespace Waredesk\Models;

use DateTime;
use Waredesk\Collections\Products\Variants;
use JsonSerializable;
use Waredesk\Image;

class Product implements JsonSerializable
{
    private $id;
    private $images;
    private $variants;
    private $name;
    private $description;
    private $notes;
    private $creation_datetime;
    private $modification_datetime;

    /**
     * @var Image
     */
    private $pendingImage;

    /**
     * @var bool
     */
    private $deleteImage;

    public function __construct(array $data = null)
    {
        $this->variants = new Variants();
        $this->reset($data);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function getVariants(): ?Variants
    {
        return $this->variants;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
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
                    case 'images':
                        $this->deleteImage = false;
                        $this->pendingImage = null;
                        $this->images = $value;
                        break;
                    case 'variants':
                        $this->variants = $value;
                        break;
                    case 'name':
                        $this->name = $value;
                        break;
                    case 'description':
                        $this->description = $value;
                        break;
                    case 'notes':
                        $this->notes = $value;
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

    public function deleteImage()
    {
        $this->deleteImage = true;
    }

    public function setImage(Image $image = null)
    {
        $this->pendingImage = $image;
    }

    public function setName(string $name = null)
    {
        $this->name = $name;
    }

    public function setDescription(string $description = null)
    {
        $this->description = $description;
    }

    public function setNotes(string $notes = null)
    {
        $this->notes = $notes;
    }

    public function jsonSerialize()
    {
        $returnValue = [
            'variants' => $this->getVariants()->jsonSerialize(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'notes' => $this->getNotes(),
        ];
        if ($this->pendingImage) {
            $returnValue['image'] = $this->pendingImage->toBase64();
        } else if ($this->deleteImage) {
            $returnValue['image'] = null;
        }
        return $returnValue;
    }
}
