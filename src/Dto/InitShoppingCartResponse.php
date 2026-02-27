<?php

namespace Nyra\Dhl\Dto;

final readonly class InitShoppingCartResponse
{
    public function __construct(public string $shopOrderId)
    {
    }

    public static function fromArray(array $data): self
    {
        return new self((string) ($data['shopOrderId'] ?? ''));
    }
}
