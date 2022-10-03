<?php

namespace App\Controller;

use App\Requests\CreateOrderRequest;
use App\Service\Order\OrderCreationService;
use App\Service\Order\OrderGettingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    public function __construct(
        private OrderGettingService $orderGettingService,
        private OrderCreationService $orderCreationService,
    ) {
    }

    #[Route('/api/v1/order/orders')]
    public function orders(): Response
    {
        return $this->json($this->orderGettingService->getOrders());
    }

    #[Route('/api/v1/order/create')]
    public function create(CreateOrderRequest $request): Response
    {
        $order = $this->orderCreationService->createOrder(
            $request->firstname,
            $request->lastname,
            $request->email,
            $request->telephone,
            $request->comment,
            $request->address,
            $request->payment_method,
            $request->products_data,
        );

        return $this->json(['id' => $order->getId()]);
    }
}
