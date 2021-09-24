<?php

namespace spec\Catalogue;

use AppException\WrongProductCodeException;
use Catalogue\Product;
use Catalogue\ProductsCollection;
use PhpSpec\ObjectBehavior;

class ProductsCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ProductsCollection::class);
    }

    function it_stores_products()
    {
        $product = new Product('Red Widget', 'R01', 32.95);
        $this->addProduct($product);
        $this->getProducts()->shouldContain($product);
    }

    function it_removes_products()
    {
        $product = new Product('Red Widget', 'R01', 32.95);
        $this->addProduct($product);
        $this->removeProduct($product);
        $this->getProducts()->shouldHaveCount(0);
    }

    function it_checks_for_products()
    {
        $product1 = new Product('Red Widget', 'R01', 32.95);
        $product2 = new Product('Green Widget', 'G01', 24.95);

        $this->addProduct($product1)->addProduct($product2);
        $this->containsProduct('R01')->shouldBe(true);
        $this->containsProduct('B01')->shouldBe(false);
    }

    function it_returns_product()
    {
        $product1 = new Product('Red Widget', 'R01', 32.95);
        $product2 = new Product('Green Widget', 'G01', 24.95);

        $this->addProduct($product1)->addProduct($product2);
        $this->getProductByCode('R01')->shouldBeAnInstanceOf(Product::class);
        $this->shouldThrow(\Exception::class)->duringGetProductByCode('B01');

    }
}
