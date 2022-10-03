<?php

namespace App\Service\Order;

use App\Entity\Order;
use App\Exceptions\ProductNotFoundException;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;

class OrderCreationService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private ProductRepository $productRepository,
        private OrderProductCreationService $orderProductCreationService,
    ) {
    }

    public function createOrder(
        string $firstname,
        ?string $lastname,
        ?string $email,
        string $telephone,
        ?string $comment,
        ?string $address,
        string $paymentMethod,
        array $productsData,
    ): Order {
        $products = [];
        $total = 0;
        foreach ($productsData as $productData) {
            $product = $this->productRepository->findOneBy(['id' => $productData['id']]);
            if ($product === null) {
                throw new ProductNotFoundException('Product not found');
            }

            $productPrice = $productData['price'];
            $quantity = $productData['quantity'];
            $product->setPrice($productPrice);

            $total += ($product->getPrice() * $quantity);
            $products[] = [
                'product' => $product,
                'quantity' => $quantity,
            ];
        }

        $order = (new Order())
            ->setFirstname($firstname)
            ->setLastname($lastname)
            ->setEmail($email)
            ->setTelephone($telephone)
            ->setComment($comment)
            ->setTotal($total)
            ->setAddress($address)
            ->setPaymentMethod($paymentMethod);

        $this->orderRepository->add($order, true);

        foreach ($products as $product) {
            $this->orderProductCreationService->createOrderProduct($order, $product['product'], $product['quantity']);
        }

        return $order;
    }
}
