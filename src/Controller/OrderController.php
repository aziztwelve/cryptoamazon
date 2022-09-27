<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends AbstractController
{
    public function __construct(
        private CategoryService $categoryService
    ) {
    }

    #[Route('/api/v1/order/orders')]
    public function orders(): Response
    {
        return $this->json($this->categoryService->getCategories());
    }
}
