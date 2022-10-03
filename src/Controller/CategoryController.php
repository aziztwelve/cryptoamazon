<?php

namespace App\Controller;

use App\Service\Category\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    public function __construct(
        private CategoryService $categoryService,
    ) {
    }

    #[Route('/api/v1/category/categories')]
    public function products(): Response
    {
        return $this->json($this->categoryService->getCategories());
    }
}
