<?php

namespace Nyra\Dhl\Dto;

final readonly class ImageItem
{
    public function __construct(
        public ?int       $imageId,
        public string     $imageDescription,
        public string     $imageSlogan,
        public MotiveLink $links
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            imageId: isset($data['imageID']) ? (int) $data['imageID'] : null,
            imageDescription: (string) ($data['imageDescription'] ?? ''),
            imageSlogan: (string) ($data['imageSlogan'] ?? ''),
            links: MotiveLink::fromArray($data['links'] ?? [])
        );
    }
}
