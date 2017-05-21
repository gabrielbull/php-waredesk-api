<?php

namespace Waredesk\Models\Product\Variant;

use DateTime;
use JsonSerializable;
use Waredesk\Entity;
use Waredesk\ReplaceableEntity;

class Price implements Entity, ReplaceableEntity, JsonSerializable
{
    private $id;
    private $price_list;
    private $currency;
    private $price;
    private $creation;
    private $modification;

    public function __clone()
    {
    }

    public function getId(): ? string
    {
        return $this->id;
    }

    public function getPriceList(): ? string
    {
        return $this->price_list;
    }

    public function getCurrency(): ? string
    {
        return $this->currency;
    }

    public function getPrice(): ? int
    {
        return $this->price;
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
                    case 'price_list':
                        $this->price_list = $value;
                        break;
                    case 'currency':
                        $this->currency = $value;
                        break;
                    case 'price':
                        $this->price = $value;
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

    public function setPriceList(string $price_list)
    {
        $this->$price_list = $price_list;
    }

    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    public function jsonSerialize(): array
    {
        return [
            'price_list' => $this->getPriceList(),
            'currency' => $this->getCurrency(),
            'price' => $this->getPrice(),
        ];
    }
}
