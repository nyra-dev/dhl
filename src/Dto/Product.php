<?php

namespace Nyra\Dhl\Dto;

final readonly class Product
{
    public function __construct(
        public ?string $productName = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            productName: $data['productName'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'productName' => $this->productName,
        ], static fn($v) => $v !== null);
    }
}
