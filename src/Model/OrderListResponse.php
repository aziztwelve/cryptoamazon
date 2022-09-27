<?php

namespace App\Model;

class OrderListResponse
{
    /**
     * @var OrderListItem[]
     */
    private array $items;

    /**
     * @param OrderListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return OrderListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
