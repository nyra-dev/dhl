<?php

namespace Nyra\Dhl\Dto;

final readonly class ErrorResponse
{
    public function __construct(
        public string $statusCode,
        public string $title,
        public string $description
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            statusCode: (string) ($data['statusCode'] ?? ''),
            title: (string) ($data['title'] ?? ''),
            description: (string) ($data['description'] ?? '')
        );
    }
}
