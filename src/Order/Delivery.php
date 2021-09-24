<?php

namespace Order;

class Delivery
{

    public function calculateDeliveryPrice(float $productTotal)
    {
        if ($productTotal < 50) {
            return 4.95;
        } elseif ($productTotal < 90) {
            return 2.95;
        }

        return 0;
    }
}
