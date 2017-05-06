<?php

namespace Waredesk\Models\Product;

use DateTime;
use JsonSerializable;
use Waredesk\Collections\Products\Variants\Codes;
use Waredesk\Collections\Products\Variants\Options;
use Waredesk\Collections\Products\Variants\Prices;
use Waredesk\Image;

class Variant implements JsonSerializable
{
    private $id;
    private $images;
    private $options;
    private $codes;
    private $prices;
    private $description;
    private $notes;
    private $weight_unit;
    private $length_unit;
    private $weight;
    private $width;
    private $height;
    private $depth;
    private $creation_datetime;
    private $modification_datetime;

    /**
     * @var Image
     */
    private $pendingImage;

    public function __construct()
    {
        $this->options = new Options();
        $this->codes = new Codes();
        $this->prices = new Prices();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id = null)
    {
        $this->id = $id;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(array $images = null)
    {
        $this->pendingImage = null;
        $this->images = $images;
    }

    public function setImage(Image $image = null)
    {
        $this->pendingImage = $image;
    }

    public function getOptions(): ?Options
    {
        return $this->options;
    }

    public function setOptions(Options $options)
    {
        $this->options = $options;
    }

    public function getCodes(): ?Codes
    {
        return $this->codes;
    }

    public function setCodes(Codes $codes)
    {
        $this->codes = $codes;
    }

    public function getPrices(): ?Prices
    {
        return $this->prices;
    }

    public function setPrices(Prices $prices)
    {
        $this->prices = $prices;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description = null)
    {
        $this->description = $description;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes = null)
    {
        $this->notes = $notes;
    }

    public function getWeightUnit(): ?string
    {
        return $this->weight_unit;
    }

    public function setWeightUnit(string $weight_unit = null)
    {
        $this->weight_unit = $weight_unit;
    }

    public function getLengthUnit(): ?string
    {
        return $this->length_unit;
    }

    public function setLengthUnit(string $length_unit = null)
    {
        $this->length_unit = $length_unit;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight = null)
    {
        $this->weight = $weight;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(float $width = null)
    {
        $this->width = $width;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height = null)
    {
        $this->height = $height;
    }

    public function getDepth(): ?float
    {
        return $this->depth;
    }

    public function setDepth(float $depth = null)
    {
        $this->depth = $depth;
    }

    public function getCreationDatetime(): ?DateTime
    {
        return $this->creation_datetime;
    }

    public function setCreationDatetime(DateTime $creation_datetime = null)
    {
        $this->creation_datetime = $creation_datetime;
    }

    public function getModificationDatetime(): ?DateTime
    {
        return $this->modification_datetime;
    }

    public function setModificationDatetime(DateTime $modification_datetime = null)
    {
        $this->modification_datetime = $modification_datetime;
    }

    public function jsonSerialize()
    {
        $returnValue = [
            'description' => $this->getDescription(),
            'notes' => $this->getNotes(),
            'options' => $this->getOptions()->jsonSerialize(),
            'codes' => $this->getCodes()->jsonSerialize(),
            'prices' => $this->getPrices()->jsonSerialize(),
            'weight_unit' => $this->getWeightUnit(),
            'length_unit' => $this->getLengthUnit(),
            'weight' => $this->getWeight(),
            'width' => $this->getWidth(),
            'height' => $this->getHeight(),
            'depth' => $this->getDepth(),
        ];
        if ($this->pendingImage) {
            $returnValue['image'] = $this->pendingImage->toBase64();
        }
        return $returnValue;
    }
}
