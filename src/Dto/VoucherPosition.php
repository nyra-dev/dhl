<?php

namespace Nyra\Dhl\Dto;

final readonly class VoucherPosition
{
    public function __construct(
        public int $labelX,
        public int $labelY,
        public int $page
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            labelX: (int) ($data['labelX'] ?? 0),
            labelY: (int) ($data['labelY'] ?? 0),
            page: (int) ($data['page'] ?? 0)
        );
    }

    public function toArray(): array
    {
        return [
            'labelX' => $this->labelX,
            'labelY' => $this->labelY,
            'page' => $this->page,
        ];
    }
}
