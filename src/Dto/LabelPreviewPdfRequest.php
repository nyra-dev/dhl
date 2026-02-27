<?php

namespace Nyra\Dhl\Dto;

final readonly class LabelPreviewPdfRequest
{
    public function __construct(
        public int           $productCode,
        public VoucherLayout $voucherLayout,
        public ?int          $imageId = null,
        public ?string       $dpi = null,
        public ?int          $pageFormatId = null,
        public string        $type = 'AppShoppingCartPreviewPDFRequest'
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
            'pageFormatId' => $this->pageFormatId,
        ], static fn($v) => $v !== null);
    }
}
