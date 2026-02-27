<?php

namespace Nyra\Dhl\Dto;

final readonly class Voucher
{
    public function __construct(public string $voucherId, public string $trackId)
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            voucherId: (string) ($data['voucherId'] ?? ''),
            trackId: (string) ($data['trackId'] ?? '')
        );
    }

    public function toArray(): array
    {
        return [
            'voucherId' => $this->voucherId,
            'trackId' => $this->trackId,
        ];
    }
}
