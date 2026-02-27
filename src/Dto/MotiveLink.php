<?php

namespace Nyra\Dhl\Dto;

final readonly class MotiveLink
{
    public function __construct(public string $link, public string $linkThumbnail)
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            link: (string) ($data['link'] ?? ''),
            linkThumbnail: (string) ($data['linkThumbnail'] ?? '')
        );
    }
}
