<?php

namespace Nyra\Dhl\Dto;

/**
 * Order item for PNG shopping cart.
 */
class ShoppingCartPosition
{
    public function __construct(
        public readonly int $productCode,
        public readonly VoucherLayout $voucherLayout,
        public readonly ?AddressBinding $address = null,
        public readonly ?int $imageId = null,
        public readonly string $positionType = 'AppShoppingCartPosition'
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            productCode: (int) ($data['productCode'] ?? 0),
            voucherLayout: VoucherLayout::from((string) ($data['voucherLayout'] ?? VoucherLayout::FRANKING_ZONE->value)),
            address: isset($data['address']) ? AddressBinding::fromArray($data['address']) : null,
            imageId: isset($data['imageID']) ? (int) $data['imageID'] : null,
            positionType: (string) ($data['positionType'] ?? 'AppShoppingCartPosition')
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'productCode' => $this->productCode,
            'voucherLayout' => $this->voucherLayout->value,
            'address' => $this->address?->toArray(),
            'imageID' => $this->imageId,
            'positionType' => $this->positionType,
        ], static fn($v) => $v !== null && $v !== '');
    }
}
