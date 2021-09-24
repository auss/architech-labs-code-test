<?php


namespace spec\Order;

use Order\Delivery;
use PhpSpec\ObjectBehavior;

class DeliverySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Delivery::class);
    }


    /*
     * Orders under $50 cost $4.95.
     * For orders under $90 , delivery costs $2.95.
     * Orders of $ 90 or more have free delivery.
     */
    function it_calculates_delivery_prices()
    {
        $this->calculateDeliveryPrice(49.99)->shouldEqual(4.95);
        $this->calculateDeliveryPrice(50.00)->shouldEqual(2.95);
        $this->calculateDeliveryPrice(90.00)->shouldEqual(0);
    }
}
