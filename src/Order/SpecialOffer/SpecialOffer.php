<?php

namespace Order\SpecialOffer;

use Catalogue\ProductsCollection;

abstract class SpecialOffer
{
    protected ProductsCollection $products;

    public function setProducts(ProductsCollection $products)
    {
        $this->products = $products;

        return $this;
    }


    public function calculate()
    {
        return $this->products;
    }

}
