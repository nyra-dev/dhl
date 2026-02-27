<?php

namespace Nyra\Dhl\Dto;

final readonly class ContractProducts
{
    /** @param list<ContractProduct> $products */
    public function __construct(public array $products)
    {
    }

    public static function fromArray(array $data): self
    {
        $products = array_map(static fn(array $item) => ContractProduct::fromArray($item), $data['products'] ?? []);

        return new self($products);
    }
}
