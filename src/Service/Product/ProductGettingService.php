<?php

namespace App\Service\Product;

use App\Entity\Product;
use App\Model\ProductListItem;
use App\Model\ProductListResponse;
use App\Repository\ProductRepository;

class ProductGettingService
{
    public function __construct(
        private ProductRepository $productRepository,
    ) {
    }

    public function getProducts(
        ?int $categoryId,
        ?int $manufacturerId,
        array $price,
    ): ProductListResponse
    {
        $products = $this->productRepository->findByFilter($categoryId, $manufacturerId, $price);

        $items = array_map(
            static fn (Product $product) => new ProductListItem(
                $product->getId(),
                $product->getName(),
                $product->getDescription(),
                $product->getSlug(),
                $product->getPrice(),
            ),
            $products
        );

        return new ProductListResponse($items);
    }
}
