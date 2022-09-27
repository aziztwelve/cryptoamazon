<?php

namespace App\Model;

class ProductListItem
{
    private int $id;

    private string $name;

    private string $description;

    private string $slug;

    private float $price;

    public function __construct(int $id, string $name, string $description, string $slug, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->slug = $slug;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
