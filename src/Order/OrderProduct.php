<?php

namespace Order;

use Catalogue\Product;

class OrderProduct extends \Catalogue\Product
{
    private bool $discountApplied = false;


    public function markDiscountApplied()
    {
        $this->discountApplied = true;

        return $this;
    }

    public function isDiscountApplied(): bool
    {
        return $this->discountApplied;
    }
}