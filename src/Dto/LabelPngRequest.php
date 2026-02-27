<?php

namespace Nyra\Dhl\Dto;

/**
 * Request to checkout a PNG shopping cart.
 */
final readonly class LabelPngRequest
{
    /**
     * @param list<ShoppingCartPosition> $positions
     */
    public function __construct(
        public int     $total,
        public array   $positions,
        public string  $shopOrderId,
        public ?bool   $createManifest = null,
        public ?string $createShippingList = null,
        public ?string $dpi = null,
        public ?bool   $optimizePng = null,
        public string  $type = 'AppShoppingCartPNGRequest'
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'shopOrderId' => $this->shopOrderId,
            'total' => $this->total,
            'createManifest' => $this->createManifest,
            'createShippingList' => $this->createShippingList,
            'dpi' => $this->dpi,
            'optimizePNG' => $this->optimizePng,
            'positions' => array_map(static fn(ShoppingCartPosition $position) => $position->toArray(), $this->positions),
        ], static fn($v) => $v !== null);
    }
}
