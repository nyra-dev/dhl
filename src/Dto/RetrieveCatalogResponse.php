<?php

namespace Nyra\Dhl\Dto;

final readonly class RetrieveCatalogResponse
{
    /** @param list<PageFormat> $pageFormats */
    public function __construct(
        public ?PrivateCatalog   $privateCatalog,
        public ?PublicCatalog    $publicCatalog,
        public array             $pageFormats,
        public ?ContractProducts $contractProducts
    ) {
    }

    public static function fromArray(array $data): self
    {
        $pageFormats = array_map(static fn(array $item) => PageFormat::fromArray($item), $data['pageFormats'] ?? []);

        return new self(
            privateCatalog: isset($data['privateCatalog']) ? PrivateCatalog::fromArray($data['privateCatalog']) : null,
            publicCatalog: isset($data['publicCatalog']) ? PublicCatalog::fromArray($data['publicCatalog']) : null,
            pageFormats: $pageFormats,
            contractProducts: isset($data['contractProducts']) ? ContractProducts::fromArray($data['contractProducts']) : null
        );
    }
}
