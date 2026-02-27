<?php

namespace Nyra\Dhl\Dto;

final readonly class Weight
{
    public function __construct(
        public ?string $unitText = null,
        public ?float $value = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            unitText: $data['unitText'] ?? null,
            value: isset($data['value']) ? (float) $data['value'] : null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'unitText' => $this->unitText,
            'value' => $this->value,
        ], static fn($v) => $v !== null);
    }
}
