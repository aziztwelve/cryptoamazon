<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::BIGINT, options: ['unsigned' => true])]
    private int $id;

    #[ORM\Column(length: 32)]
    private string $firstname;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 96, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 32)]
    private string $telephone;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private float $total;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 128)]
    private string $payment_method;

    /**
     * @var Collection<OrderProduct>
     */
    #[ORM\OneToMany(mappedBy: 'order', targetEntity: OrderProduct::class)]
    private Collection $ordersProducts;

    public function __construct()
    {
        $this->ordersProducts = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPaymentMethod(): string
    {
        return $this->payment_method;
    }

    public function setPaymentMethod(string $payment_method): self
    {
        $this->payment_method = $payment_method;

        return $this;
    }

    /**
     * @return Collection<OrderProduct>
     */
    public function getOrdersProducts(): Collection
    {
        return $this->ordersProducts;
    }

    /**
     * @param Collection<OrderProduct> $orderProducts
     * @return $this
     */
    public function setOrdersProducts(Collection $orderProducts): self
    {
        $this->ordersProducts = $orderProducts;

        return  $this;
    }
}
