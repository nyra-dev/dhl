<?php

namespace Nyra\Dhl\Dto;

final readonly class PublicCatalog
{
    /** @param list<CatalogItem> $items */
    public function __construct(public array $items)
    {
    }

    public static function fromArray(array $data): self
    {
        $items = array_map(static fn(array $item) => CatalogItem::fromArray($item), $data['items'] ?? []);

        return new self($items);
    }
}
