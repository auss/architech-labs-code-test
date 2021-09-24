<?php

namespace Order\SpecialOffer;

use Catalogue\ProductsCollection;
use Order\OrderProduct;

class SecondHalfCheaperOffer extends SpecialOffer
{
    private array $applicableProducts = array('R01');

    public function calculate(): ProductsCollection
    {
        $apply = false;
        /**
         * @var OrderProduct $product
         *
         * Go over all products, when first applicable product will be found, set the flag to true.
         * When second applicable product will be found (flag is true), divide the price by 2 and set the flag to false
         */
        foreach ($this->products->getProducts() as $product) {
            if (in_array($product->getCode(), $this->applicableProducts)) {
                if ($apply) {
                    // make sure that the discount is not applied more than once
                    if (!$product->isDiscountApplied()) {
                        $product->setPrice($product->getPrice() / 2);
                        $product->markDiscountApplied();
                    }
                    $apply = false;
                } else {
                    $apply = true;
                }
            }
        }

        return parent::calculate();
    }
}
