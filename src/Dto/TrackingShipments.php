<?php

namespace Nyra\Dhl\Dto;

/**
 * Shopping cart representation.
 */
final readonly class TrackingShipments
{
    public function __construct(
        public array $shipments,
    )
    {
        //
    }

    public static function fromArray(array $data): self
    {
        return new self(
            shipments: array_map(static fn(array $item) => Shipment::fromArray($item), $data['shipments'] ?? [])
        );
    }

    public function toArray(): array
    {
        return [
            'shipments' => array_map(static fn(Shipment $voucher) => $voucher->toArray(), $this->shipments),
        ];
    }
}
