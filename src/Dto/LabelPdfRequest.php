<?php

namespace Nyra\Dhl\Dto;

/**
 * Request to check out a PDF shopping cart.
 */
final readonly class LabelPdfRequest
{
    /** @param list<ShoppingCartPDFPosition> $positions */
    public function __construct(
        public int     $total,
        public array   $positions,
        public string  $shopOrderId,
        public int     $pageFormatId,
        public ?bool   $createManifest = null,
        public ?string $createShippingList = null,
        public ?string $dpi = null,
        public string  $type = 'AppShoppingCartPDFRequest'
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
            'pageFormatId' => $this->pageFormatId,
            'positions' => array_map(static fn(ShoppingCartPDFPosition $position) => $position->toArray(), $this->positions),
        ], static fn($v) => $v !== null);
    }
}
