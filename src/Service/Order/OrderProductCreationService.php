<?php

namespace App\Service\Order;

use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\Product;
use App\Repository\OrderProductRepository;

class OrderProductCreationService
{
    public function __construct(
        private OrderProductRepository $orderProductRepository,
    ) {
    }

    public function createOrderProduct(Order $order, Product $product, int $quantity): OrderProduct
    {
        $orderProduct = new OrderProduct();
        $orderProduct->setOrder($order);
        $orderProduct->setProduct($product);
        $orderProduct->setQuantity($quantity);
        $orderProduct->setPrice($product->getPrice());

        $total = $product->getPrice() * $quantity;

        $orderProduct->setTotal($total);

        $this->orderProductRepository->add($orderProduct, true);

        return $orderProduct;
    }
}
