<?php

namespace Catalogue;

class ProductsCollection
{
    protected $products = array();

    public function addProduct(Product $product) : self
    {
        $this->products[$product->getCode()] = $product;
        return $this;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function removeProduct(Product $product):self
    {
        return $this->removeProductByCode($product->getCode());
    }


    public function removeProductByCode(string $code):self
    {
        if (array_key_exists($code, $this->products)) {
            unset($this->products[$code]);
        }

        return $this;
    }

    public function containsProduct(string $code):bool
    {
        return array_key_exists($code, $this->products) && $this->products[$code] instanceof Product;
    }

    public function getProductByCode(string $code):Product
    {
        if (!$this->containsProduct($code)) {
            throw new \Exception('Product code not found');
        }

        return $this->products[$code];
    }


    public function clear():self
    {
        $this->products = array();

        return $this;
    }


}
