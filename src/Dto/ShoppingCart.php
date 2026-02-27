<?php

namespace Nyra\Dhl\Dto;

/**
 * Shopping cart representation.
 */
final readonly class ShoppingCart
{
    /** @param list<Voucher> $voucherList */
    public function __construct(
        public string $shopOrderId,
        public array  $voucherList
    ) {
    }

    public static function fromArray(array $data): self
    {
        $vouchers = array_map(static fn(array $item) => Voucher::fromArray($item), $data['voucherList'] ?? []);

        return new self(
            shopOrderId: (string) ($data['shopOrderId'] ?? ''),
            voucherList: $vouchers
        );
    }

    public function toArray(): array
    {
        return [
            'shopOrderId' => $this->shopOrderId,
            'voucherList' => array_map(static fn(Voucher $voucher) => $voucher->toArray(), $this->voucherList),
        ];
    }
}
