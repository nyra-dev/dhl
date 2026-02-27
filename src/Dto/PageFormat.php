<?php

namespace Nyra\Dhl\Dto;

final readonly class PageFormat
{
    public function __construct(
        public string     $name,
        public string     $pageType,
        public PageLayout $pageLayout,
        public ?int       $id = null,
        public ?bool      $isAddressPossible = null,
        public ?bool      $isImagePossible = null,
        public ?string    $description = null
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: (string) ($data['name'] ?? ''),
            pageType: (string) ($data['pageType'] ?? ''),
            pageLayout: PageLayout::fromArray($data['pageLayout'] ?? []),
            id: isset($data['id']) ? (int) $data['id'] : null,
            isAddressPossible: isset($data['isAddressPossible']) ? (bool) $data['isAddressPossible'] : null,
            isImagePossible: isset($data['isImagePossible']) ? (bool) $data['isImagePossible'] : null,
            description: $data['description'] ?? null
        );
    }
}
