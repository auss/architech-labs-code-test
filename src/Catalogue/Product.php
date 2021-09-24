<?php

namespace Catalogue;

class Product
{
    private string $name;
    private string $code;
    private float $price;

    public function __construct(string $name, string $code, float $price)
    {
        $this->name = $name;
        $this->code = $code;
        $this->price = $price;
    }

    public function getCode(): string
    {
        return $this->code;
    }


    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(float $price)
    {
        $this->price = round($price, 2);

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }
}
