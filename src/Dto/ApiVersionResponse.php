<?php

namespace Nyra\Dhl\Dto;

final readonly class ApiVersionResponse
{
    public function __construct(
        public ?string $env,
        public ?string $version,
        public ?string $description
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            env: $data['env'] ?? null,
            version: $data['version'] ?? null,
            description: $data['description'] ?? null
        );
    }
}
