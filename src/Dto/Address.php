<?php

namespace Nyra\Dhl\Dto;

final readonly class Address
{
    public function __construct(
        public string  $name,
        public string  $addressLine1,
        public string  $city,
        public string  $postalCode,
        public string  $country,
        public ?string $additionalName = null,
        public ?string $addressLine2 = null,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            addressLine1: $data['addressLine1'],
            city: $data['city'],
            postalCode: $data['postalCode'],
            country: $data['country'],
            additionalName: $data['additionalName'] ?? null,
            addressLine2: $data['addressLine2'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'additionalName' => $this->additionalName,
            'addressLine1' => $this->addressLine1,
            'addressLine2' => $this->addressLine2,
            'postalCode' => $this->postalCode,
            'city' => $this->city,
            'country' => $this->country,
        ], static fn($v) => $v !== null);
    }
}
