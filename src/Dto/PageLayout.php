<?php

namespace Nyra\Dhl\Dto;

final readonly class PageLayout
{
    public function __construct(
        public Dimension       $size,
        public string          $orientation,
        public Dimension       $labelSpacing,
        public Position        $labelCount,
        public BorderDimension $margin
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            size: Dimension::fromArray($data['size'] ?? []),
            orientation: (string) ($data['orientation'] ?? ''),
            labelSpacing: Dimension::fromArray($data['labelSpacing'] ?? []),
            labelCount: Position::fromArray($data['labelCount'] ?? []),
            margin: BorderDimension::fromArray($data['margin'] ?? [])
        );
    }
}
