<?php

namespace Nyra\Dhl\Dto;

final readonly class Event
{
    public function __construct(
        public string $timestamp,
        public ?Location $location = null,
        public ?string $statusCode = null,
        public ?string $status = null,
        public ?string $statusDetailed = null,
        public ?string $description = null,
        public ?string $remark = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            timestamp: $data['timestamp'] ?? '',
            location: isset($data['location']) && is_array($data['location']) ? Location::fromArray($data['location']) : null,
            statusCode: $data['statusCode'] ?? null,
            status: $data['status'] ?? null,
            statusDetailed: $data['statusDetailed'] ?? null,
            description: $data['description'] ?? null,
            remark: $data['remark'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'timestamp' => $this->timestamp,
            'location' => $this->location?->toArray(),
            'statusCode' => $this->statusCode,
            'status' => $this->status,
            'statusDetailed' => $this->statusDetailed,
            'description' => $this->description,
            'remark' => $this->remark,
        ], static fn($v) => $v !== null);
    }
}
