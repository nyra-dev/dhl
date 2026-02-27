<?php

namespace Nyra\Dhl\Dto;

final readonly class LabelPreviewPngRequest
{
    public function __construct(
        public int           $productCode,
        public VoucherLayout $voucherLayout,
        public ?int          $imageId = null,
        public ?string       $dpi = null,
        public ?bool         $optimizePng = null,
        public string        $type = 'AppShoppingCartPreviewPNGRequest'
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'productCode' => $this->productCode,
            'voucherLayout' => $this->voucherLayout->value,
            'imageID' => $this->imageId,
            'dpi' => $this->dpi,
            'optimizePNG' => $this->optimizePng,
        ], static fn($v) => $v !== null);
    }
}
