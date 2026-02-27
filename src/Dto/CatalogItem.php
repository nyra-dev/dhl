<?php

namespace Nyra\Dhl\Dto;

/**
 * Public motif catalog item.
 */
final readonly class CatalogItem
{
    /** @param list<ImageItem> $images */
    public function __construct(
        public string $category,
        public string $categoryDescription,
        public array  $images,
        public ?int   $categoryId = null
    ) {
    }

    public static function fromArray(array $data): self
    {
        $images = array_map(static fn(array $item) => ImageItem::fromArray($item), $data['images'] ?? []);

        return new self(
            category: (string) ($data['category'] ?? ''),
            categoryDescription: (string) ($data['categoryDescription'] ?? ''),
            images: $images,
            categoryId: isset($data['categoryId']) ? (int) $data['categoryId'] : null
        );
    }
}
