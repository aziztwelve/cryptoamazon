<?php

namespace App\Service\Category;

use App\Entity\Category;
use App\Model\CategoryListItem;
use App\Model\CategoryListResponse;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Criteria;

class CategoryService
{
    public function __construct(
        private CategoryRepository $categoryRepository,
    ) {
    }

    public function getCategories(): CategoryListResponse
    {
        $categories = $this->categoryRepository->findAll([], ['name' => Criteria::ASC]);

        $items = array_map(
            static fn (Category $category) => new CategoryListItem(
                $category->getId(),
                $category->getName(),
            ),
            $categories
        );

        return new CategoryListResponse($items);
    }
}
