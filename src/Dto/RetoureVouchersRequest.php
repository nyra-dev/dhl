<?php

namespace Nyra\Dhl\Dto;

final readonly class RetoureVouchersRequest
{
    public function __construct(public ShoppingCart $shoppingCart)
    {
    }

    public function toArray(): array
    {
        return [
            'shoppingCart' => $this->shoppingCart->toArray(),
        ];
    }
}
