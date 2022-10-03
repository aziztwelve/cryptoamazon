<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class CreateOrderRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 32,
        minMessage: 'Your first name must be at least {{ limit }} characters long',
        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
    )]
    public string $firstname;

    #[Assert\Type(type: 'string')]
    public ?string $lastname = '';

    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    public ?string $email = '';

    #[Assert\NotBlank]
    public string $telephone;

    #[Assert\Type(type: 'string')]
    public ?string $comment = '';

    #[Assert\Type(type: 'string')]
    public ?string $address = '';

    #[Assert\NotBlank]
    #[Assert\Choice(['card', 'cash'])]
    public string $payment_method;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'array')]
    public array $products_data;
}
