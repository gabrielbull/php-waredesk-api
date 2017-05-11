<?php

namespace Waredesk\Models\Product\Variant;

use DateTime;
use JsonSerializable;

class Price implements JsonSerializable
{
    private $id;
    private $price_list_id;
    private $currency;
    private $price;
    private $creation_datetime;
    private $modification_datetime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriceListId(): ?int
    {
        return $this->price_list_id;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function getPrice(): ?int
    {
        return $this->price;
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
                    case 'price_list_id':
                        $this->price_list_id = $value;
                        break;
                    case 'currency':
                        $this->currency = $value;
                        break;
                    case 'price':
                        $this->price = $value;
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

    public function setPriceList(int $price_list_id)
    {
        $this->price_list_id = $price_list_id;
    }

    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    public function jsonSerialize()
    {
        return [
            'price_list_id' => $this->getPriceListId(),
            'currency' => $this->getCurrency(),
            'price' => $this->getPrice(),
        ];
    }
}
