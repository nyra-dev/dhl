<?php

namespace Nyra\Dhl\Dto;

final readonly class Location
{
    public function __construct(
        public ?SimpleAddress $address = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            address: isset($data['address']) && is_array($data['address']) ? SimpleAddress::fromArray($data['address']) : null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'address' => $this->address?->toArray(),
        ], static fn($v) => $v !== null);
    }
}
