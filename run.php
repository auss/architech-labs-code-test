<?php

require_once 'vendor/autoload.php';

use Catalogue\Product;
use Catalogue\ProductsCollection;
use Order\Delivery;
use Order\SpecialOffer\SecondHalfCheaperOffer;
use Order\ShoppingCart;

$productCollection = new ProductsCollection();
$productCollection->addProduct(new Product('Red Widget', 'R01', 32.95))
    ->addProduct(new Product('Green Widget', 'G01', 24.95))
    ->addProduct(new Product('Blue Widget', 'B01', 7.95));

$delivery = new Delivery();


$cart = new ShoppingCart($productCollection, $delivery, array(new SecondHalfCheaperOffer()));
$cart->addProduct('B01');
$cart->addProduct('G01');
echo 'B01,G01 = $'.$cart->getTotal();
echo "\n\r";

$cart->clear();
$cart->addProduct('R01',2);
echo 'R01,R01 = $'.$cart->getTotal();
echo "\n\r";

$cart->clear();
$cart->addProduct('R01');
$cart->addProduct('G01');
echo 'R01,G01 = $'.$cart->getTotal();
echo "\n\r";

$cart->clear();
$cart->addProduct('B01', 2);
$cart->addProduct('R01', 3);
echo 'B01,B01, R01, R01, R01 = $'.$cart->getTotal();
echo "\n\r";