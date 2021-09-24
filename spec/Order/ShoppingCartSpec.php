<?php

namespace spec\Order;

use Catalogue\Product;
use Catalogue\ProductsCollection;
use Order\Delivery;
use Order\SpecialOffer\SecondHalfCheaperOffer;
use Order\ShoppingCart;
use PhpSpec\ObjectBehavior;

class ShoppingCartSpec extends ObjectBehavior
{


    function let()
    {
        $productCollection = new ProductsCollection();
        $productCollection->addProduct(new Product('Red Widget', 'R01', 32.95))
            ->addProduct(new Product('Green Widget', 'G01', 24.95))
            ->addProduct(new Product('Blue Widget', 'B01', 7.95));

        $delivery = new Delivery();


        $this->beConstructedWith($productCollection, $delivery, array(new SecondHalfCheaperOffer()));
    }


    function it_is_initializable()
    {
        $this->shouldHaveType(ShoppingCart::class);
    }

    function it_stores_product()
    {
        $this->addProduct('G01');
        $this->getProductTotal()->shouldEqual(24.95);
    }

    function it_calculates_product_totals()
    {
        $this->addProduct('R01');
        $this->getProductTotal()->shouldEqual(32.95);
        $this->addProduct('B01');
        $this->getProductTotal()->shouldEqual(40.90);
        $this->addProduct('R01', 2);
        $this->addProduct('G01', 3);
        $this->getProductTotal()->shouldEqual(165.18);
    }

    function it_calculates_special_offers()
    {
        $this->addProduct('R01', 1);
        $this->getProductTotal()->shouldEqual(32.95);
        $this->addProduct('R01', 1);
        $this->getProductTotal()->shouldEqual(49.43);
    }

    function it_calculates_total_scenario1()
    {
        $this->addProduct('B01');
        $this->addProduct('G01');
        $this->getTotal()->shouldEqual(37.85);
    }

    function it_calculates_total_scenario2()
    {
        $this->addProduct('R01', 2);
        $this->getTotal()->shouldEqual(54.38);
    }

    function it_calculates_total_scenario3()
    {
        $this->addProduct('R01');
        $this->addProduct('G01');
        $this->getTotal()->shouldEqual(60.85);
    }


    function it_calculates_total_scenario4()
    {
        $this->addProduct('B01', 2);
        $this->addProduct('R01', 3);
        $this->getTotal()->shouldEqual(98.28);
    }
}
