<?php

namespace App\Service\Order;

use App\Model\OrderListItem;
use App\Model\OrderListResponse;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;

class OrderGettingService
{
    public function __construct(
        private OrderRepository $orderRepository,
    ) {
    }

    public function getOrders(): OrderListResponse
    {
        $orders = $this->orderRepository->getOrdersWithProducts();

        $items = array_map([$this, 'assembleOrderData'], $orders);

        return new OrderListResponse($items);
    }

    private function assembleOrderData(array $order): OrderListItem
    {
        $productsData = $order['ordersProducts'];

        $products = [];
        foreach ($productsData as $productData) {
            $products[] = [
                'quantity' => $productData['quantity'],
                'total' => $productData['total'],
                'order_price' => $productData['price'],
                'product_id' => $productData['product']['id'],
                'product_name' => $productData['product']['name'],
                'product_description' => $productData['product']['description'],
                'product_slug' => $productData['product']['slug'],
                'product_price' => $productData['product']['price'],
            ];
        }

        return new OrderListItem(
            $order['id'],
            $order['firstname'],
            $order['lastname'],
            $order['email'],
            $order['telephone'],
            $order['comment'],
            $order['total'],
            $order['address'],
            $order['payment_method'],
            new ArrayCollection($products),
        );
    }
}
