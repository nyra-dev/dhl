<?php

namespace Nyra\Dhl\Dto;

final readonly class ContractProduct
{
    public function __construct(public int $productCode, public int $price)
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            productCode: (int) ($data['productCode'] ?? 0),
            price: (int) ($data['price'] ?? 0)
        );
    }
}
