<?php

namespace Nyra\Dhl\Dto;

final readonly class BorderDimension
{
    public function __construct(
        public float $top,
        public float $bottom,
        public float $left,
        public float $right
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            top: (float) ($data['top'] ?? 0.0),
            bottom: (float) ($data['bottom'] ?? 0.0),
            left: (float) ($data['left'] ?? 0.0),
            right: (float) ($data['right'] ?? 0.0)
        );
    }
}
