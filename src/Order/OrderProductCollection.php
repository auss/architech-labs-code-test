<?php

namespace Order;

use Catalogue\Product;

class OrderProductCollection extends \Catalogue\ProductsCollection
{
    public function addProduct(Product $product):self
    {
        $this->products[] = $product;

        return $this;
    }

    public function removeProductByCode(string $code):self
    {
        foreach ($this->getProducts() as $key => $product) {
            if ($product->getCode() == $code) {
                unset($this->products[$code]);
                return $this;
            }
        }

        return $this;
    }

    public function containsProduct(string $code):bool
    {
        foreach ($this->getProducts() as $key => $product) {
            if ($product->getCode() == $code) {
                return true;
            }
        }
        return false;
    }
}