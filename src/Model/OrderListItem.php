<?php

namespace App\Model;

use App\Entity\Product;
use Doctrine\Common\Collections\Collection;

class OrderListItem
{
    private int $id;

    private string $firstname;

    private ?string $lastname;

    private ?string $email;

    private string $telephone;

    private ?string $comment;

    private float $total;

    private ?string $address;

    private string $payment_method;

    private Collection $orderProducts;

    public function __construct(
        int $id,
        string $firstname,
        ?string $lastname,
        ?string $email,
        string $telephone,
        ?string $comment,
        float $total,
        ?string $address,
        string $payment_method,
//        Collection $orderProducts,
    ) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->comment = $comment;
        $this->total = $total;
        $this->address = $address;
        $this->payment_method = $payment_method;
//        $this->orderProducts = $orderProducts;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getPaymentMethod(): string
    {
        return $this->payment_method;
    }

    public function setPaymentMethod(string $payment_method): void
    {
        $this->payment_method = $payment_method;
    }

    /**
     * @return Collection<Product>
     */
    public function getOrderProducts(): Collection
    {
        return $this->orderProducts;
    }

    /**
     * @param Collection<Product> $orderProducts
     */
    public function setOrderProducts(Collection $orderProducts): void
    {
        $this->orderProducts = $orderProducts;
    }
}
