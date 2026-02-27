<?php

namespace Nyra\Dhl\Dto;

final readonly class Dimensions
{
    public function __construct(
        public ?array $height = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            height: isset($data['height']) && is_array($data['height']) ? $data['height'] : null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'height' => $this->height,
        ], static fn($v) => $v !== null);
    }
}
