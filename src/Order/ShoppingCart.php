<?php

namespace Order;

use Catalogue\ProductsCollection;
use Order\SpecialOffer\SpecialOffer;
use phpDocumentor\Reflection\Types\Float_;
use phpDocumentor\Reflection\Types\Integer;

class ShoppingCart
{
    private ProductsCollection $productsCollection;
    private Delivery $delivery;
    private array $specialOfferCollection;
    private float $productTotal = 0;
    private float $total = 0;
    private OrderProductCollection $products;

    public function __construct(ProductsCollection $productsCollection, Delivery $delivery, array $specialOfferCollection)
    {
        $this->productsCollection = $productsCollection;
        $this->delivery = $delivery;
        $this->specialOfferCollection = $specialOfferCollection;
        $this->products = new OrderProductCollection();
    }

    public function addProduct(string $code, $count = 1): self
    {
        $product = $this->productsCollection->getProductByCode($code);
        $count = intval($count);

        for ($i = 0; $i < $count; $i++) {
            $this->products->addProduct(new OrderProduct($product->getName(), $product->getCode(), $product->getPrice()));
        }

        $this->calculateSpecialOffers();

        return $this;
    }

    public function getTotal(): float
    {
        $productTotal = $this->getProductTotal();
        $delivery = $this->delivery->calculateDeliveryPrice($productTotal);

        return round($productTotal + $delivery, 2);
    }

    public function getProductTotal(): float
    {
        $total = 0;
        foreach ($this->products->getProducts() as $product) {
            $total += $product->getPrice();
        }

        return round($total, 2);
    }

    public function removeProduct(string $code):self
    {
        $this->products->removeProductByCode($code);

        return $this;
    }

    public function clear():self
    {
        $this->products->clear();

        return $this;
    }

    private function calculateSpecialOffers():self
    {
        /**
         * @var SpecialOffer $specialOffer
         */
        foreach ($this->specialOfferCollection as $specialOffer) {
            $specialOffer->setProducts($this->products);
            $this->products = $specialOffer->calculate();
        }

        return $this;
    }
}
