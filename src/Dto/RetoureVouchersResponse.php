<?php

namespace Nyra\Dhl\Dto;

final readonly class RetoureVouchersResponse
{
    public function __construct(
        public string $shopRetoureId,
        public string $retoureTransactionId
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            shopRetoureId: (string) ($data['shopRetoureId'] ?? ''),
            retoureTransactionId: (string) ($data['retoureTransactionId'] ?? '')
        );
    }
}
