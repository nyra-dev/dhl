<?php

namespace Nyra\Dhl\Dto;

/**
 * Order item for PDF shopping cart.
 */
final class AppShoppingCartPDFPosition extends AppShoppingCartPosition
{
    public function __construct(
        int $productCode,
        VoucherLayout $voucherLayout,
        public readonly VoucherPosition $position,
        ?AddressBinding $address = null,
        ?int $imageId = null,
        string $positionType = 'AppShoppingCartPDFPosition'
    ) {
        parent::__construct($productCode, $voucherLayout, $address, $imageId, $positionType);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            productCode: (int) ($data['productCode'] ?? 0),
            voucherLayout: VoucherLayout::from((string) ($data['voucherLayout'] ?? VoucherLayout::FRANKING_ZONE->value)),
            position: VoucherPosition::fromArray($data['position'] ?? []),
            address: isset($data['address']) ? AddressBinding::fromArray($data['address']) : null,
            imageId: isset($data['imageID']) ? (int) $data['imageID'] : null,
            positionType: (string) ($data['positionType'] ?? 'AppShoppingCartPDFPosition')
        );
    }

    public function toArray(): array
    {
        $base = parent::toArray();
        $base['position'] = $this->position->toArray();
        $base['positionType'] = $this->positionType;

        return $base;
    }
}
