<?php

namespace Nyra\Dhl\Dto;

final readonly class ChargeWalletResponse
{
    public function __construct(
        public string $shopOrderId,
        public ?int   $walletBalance = null
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            shopOrderId: (string) ($data['shopOrderId'] ?? ''),
            walletBalance: isset($data['walletBalance']) ? (int) $data['walletBalance'] : null
        );
    }
}
