<?php

namespace Nyra\Dhl\Dto;

final readonly class PrivateCatalog
{
    /** @param list<MotiveLink> $imageLink */
    public function __construct(public array $imageLink)
    {
    }

    public static function fromArray(array $data): self
    {
        $links = array_map(static fn(array $item) => MotiveLink::fromArray($item), $data['imageLink'] ?? []);

        return new self($links);
    }
}
