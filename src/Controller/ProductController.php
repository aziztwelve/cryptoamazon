<?php

namespace App\Controller;

use App\Requests\GetProductRequest;
use App\Service\Product\ProductGettingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private ProductGettingService $productGettingService,
    ) {
    }

    #[Route('/api/v1/product/products')]
    public function products(GetProductRequest $request): Response
    {
        $products = $this->productGettingService->getProducts(
            $request->category_id,
            $request->manufacturer_id,
            $request->price,
        );

        return $this->json($products);
    }
}
