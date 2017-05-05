<?php

namespace Waredesk\Models\Product\Variant;

use DateTime;

class Price
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

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getPriceListId(): ?int
    {
        return $this->price_list_id;
    }

    public function setPriceListId(int $price_list_id)
    {
        $this->price_list_id = $price_list_id;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price)
    {
        $this->price = $price;
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
