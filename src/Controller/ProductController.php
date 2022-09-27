<?php

namespace App\Controller;

use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private ProductService $productService
    ) {
    }

    #[Route('/api/v1/product/products')]
    public function products(): Response
    {
        return $this->json($this->productService->getProducts());
    }
}
