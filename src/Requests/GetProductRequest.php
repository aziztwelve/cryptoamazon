<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class GetProductRequest extends BaseRequest
{
    #[Assert\Type(type: 'integer')]
    public ?int $category_id = null;

    #[Assert\Type(type: 'integer')]
    public ?int $manufacturer_id = null;

    #[Assert\Type(type: 'array')]
    public ?array $price = null;
}
