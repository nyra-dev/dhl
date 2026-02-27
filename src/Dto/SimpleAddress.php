<?php

namespace Nyra\Dhl\Dto;

final readonly class SimpleAddress
{
    public function __construct(
        public ?string $countryCode = null,
        public ?string $addressLocality = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            countryCode: $data['countryCode'] ?? null,
            addressLocality: $data['addressLocality'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'countryCode' => $this->countryCode,
            'addressLocality' => $this->addressLocality,
        ], static fn($v) => $v !== null);
    }
}
