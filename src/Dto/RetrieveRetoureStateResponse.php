<?php

namespace Nyra\Dhl\Dto;

final readonly class RetrieveRetoureStateResponse
{
    /** @param list<RetoureState> $items */
    public function __construct(public array $items)
    {
    }

    public static function fromArray(array $data): self
    {
        $itemsRaw = $data['RetrieveRetoureStateResponse'] ?? [];
        $items = array_map(static fn(array $item) => RetoureState::fromArray($item), $itemsRaw);

        return new self($items);
    }
}
