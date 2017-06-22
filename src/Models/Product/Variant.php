<?php

namespace Waredesk\Models\Product;

use DateTime;
use JsonSerializable;
use Waredesk\Collections\Products\Variants\Items\Attributes as ItemsAttributes;
use Waredesk\Collections\Products\Variants\Attributes;
use Waredesk\Collections\Products\Variants\Codes;
use Waredesk\Collections\Products\Variants\Prices;
use Waredesk\Entity;
use Waredesk\Image;
use Waredesk\ReplaceableEntity;

class Variant implements Entity, ReplaceableEntity, JsonSerializable
{
    public const WEIGHT_UNIT_IMPERIAL = 'imperial';
    public const WEIGHT_UNIT_METRIC = 'metric';
    public const LENGTH_UNIT_IMPERIAL = 'imperial';
    public const LENGTH_UNIT_METRIC = 'metric';

    private $id;
    private $images;
    private $attributes;
    private $prices;
    private $codes;
    private $items_attributes;
    private $name;
    private $description;
    private $note;
    private $weight_unit = self::WEIGHT_UNIT_METRIC;
    private $length_unit = self::LENGTH_UNIT_METRIC;
    private $weight;
    private $width;
    private $height;
    private $depth;
    private $creation;
    private $modification;

    /**
     * @var Image
     */
    private $pendingImage;

    /**
     * @var bool
     */
    private $deleteImage = false;

    public function __construct()
    {
        $this->attributes = new Attributes();
        $this->codes = new Codes();
        $this->prices = new Prices();
        $this->items_attributes = new ItemsAttributes();
    }

    public function __clone()
    {
        $this->attributes = clone $this->attributes;
        $this->codes = clone $this->codes;
        $this->prices = clone $this->prices;
    }

    public function getId(): ? string
    {
        return $this->id;
    }

    public function getImages(): ? array
    {
        return $this->images;
    }

    public function getAttributes(): ? Attributes
    {
        return $this->attributes;
    }

    public function getPrices(): ? Prices
    {
        return $this->prices;
    }

    public function getCodes(): ? Codes
    {
        return $this->codes;
    }

    public function getItemsAttributes(): ? ItemsAttributes
    {
        return $this->items_attributes;
    }

    public function getName(): ? string
    {
        return $this->name;
    }

    public function getDescription(): ? string
    {
        return $this->description;
    }

    public function getNote(): ? string
    {
        return $this->note;
    }

    public function getWeightUnit(): ? string
    {
        return $this->weight_unit;
    }

    public function getLengthUnit(): ? string
    {
        return $this->length_unit;
    }

    public function getWeight(): ? float
    {
        return $this->weight;
    }

    public function getWidth(): ? float
    {
        return $this->width;
    }

    public function getHeight(): ? float
    {
        return $this->height;
    }

    public function getDepth(): ? float
    {
        return $this->depth;
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
                    case 'images':
                        $this->deleteImage = false;
                        $this->pendingImage = null;
                        $this->images = $value;
                        break;
                    case 'attributes':
                        $this->attributes = $value;
                        break;
                    case 'prices':
                        $this->prices = $value;
                        break;
                    case 'codes':
                        $this->codes = $value;
                        break;
                    case 'items_attributes':
                        $this->items_attributes = $value;
                        break;
                    case 'name':
                        $this->name = $value;
                        break;
                    case 'description':
                        $this->description = $value;
                        break;
                    case 'note':
                        $this->note = $value;
                        break;
                    case 'weight_unit':
                        $this->weight_unit = $value;
                        break;
                    case 'length_unit':
                        $this->length_unit = $value;
                        break;
                    case 'weight':
                        $this->weight = $value;
                        break;
                    case 'width':
                        $this->width = $value;
                        break;
                    case 'height':
                        $this->height = $value;
                        break;
                    case 'depth':
                        $this->depth = $value;
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

    public function deleteImage()
    {
        $this->deleteImage = true;
    }

    public function setImage(Image $image = null)
    {
        $this->pendingImage = $image;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setDescription(string $description = null)
    {
        $this->description = $description;
    }

    public function setNote(string $note = null)
    {
        $this->note = $note;
    }

    public function setWeightUnit(string $weight_unit = null)
    {
        $this->weight_unit = $weight_unit;
    }

    public function setLengthUnit(string $length_unit = null)
    {
        $this->length_unit = $length_unit;
    }

    public function setWeight(float $weight = null)
    {
        $this->weight = $weight;
    }

    public function setWidth(float $width = null)
    {
        $this->width = $width;
    }

    public function setHeight(float $height = null)
    {
        $this->height = $height;
    }

    public function setDepth(float $depth = null)
    {
        $this->depth = $depth;
    }

    public function jsonSerialize(): array
    {
        $returnValue = [
            'attributes' => $this->getAttributes()->jsonSerialize(),
            'prices' => $this->getPrices()->jsonSerialize(),
            'codes' => $this->getCodes()->jsonSerialize(),
            'items_attributes' => $this->getItemsAttributes()->jsonSerialize(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'note' => $this->getNote(),
            'weight_unit' => $this->getWeightUnit(),
            'length_unit' => $this->getLengthUnit(),
            'weight' => $this->getWeight(),
            'width' => $this->getWidth(),
            'height' => $this->getHeight(),
            'depth' => $this->getDepth(),
        ];
        if ($this->pendingImage) {
            $returnValue['image'] = $this->pendingImage->toBase64();
        } elseif ($this->deleteImage) {
            $returnValue['image'] = null;
        }
        if ($this->getId()) {
            $returnValue = array_merge(['id' => $this->getId()], $returnValue);
        }
        return $returnValue;
    }
}
