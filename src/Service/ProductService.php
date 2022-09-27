<?php

namespace App\Service;

use App\Entity\Product;
use App\Model\ProductListItem;
use App\Model\ProductListResponse;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\Criteria;

class ProductService
{
    public function __construct(
        private ProductRepository $productRepository
    ) {
    }

    public function getProducts(): ProductListResponse
    {
        $products = $this->productRepository->findAll([], ['name' => Criteria::ASC]);

        $items = array_map(
            fn (Product $product) => new ProductListItem(
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
