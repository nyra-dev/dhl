<?php

namespace Nyra\Dhl\Dto;

final readonly class Position
{
    public function __construct(public int $labelX, public int $labelY)
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            labelX: (int) ($data['labelX'] ?? 0),
            labelY: (int) ($data['labelY'] ?? 0)
        );
    }
}
