<?php

namespace Nyra\Dhl\Dto;

final readonly class Dimension
{
    public function __construct(public float $x, public float $y)
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            x: (float) ($data['x'] ?? 0.0),
            y: (float) ($data['y'] ?? 0.0)
        );
    }
}
