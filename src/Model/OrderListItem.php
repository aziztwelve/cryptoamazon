<?php

namespace App\Model;

use Doctrine\Common\Collections\Collection;

class OrderListItem
{
    private int $id;

    private string $firstname;

    private string $lastname;

    private string $email;

    private string $telephone;

    private string $comment;

    private float $total;

    private string $address;

    private string $payment_method;

    private Collection $orderProducts;

}