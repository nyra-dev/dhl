<?php

namespace Nyra\Dhl\Dto;

final readonly class Shipment
{
    public function __construct(
        public string $id,
        public ?string $service = null,
        public ?Location $origin = null,
        public ?Location $destination = null,
        public ?Event $status = null,
        public ?string $serviceUrl = null,
        public ?bool $returnFlag = null,
        public ?array $details = null,
        public array $events = [],
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? ($data['voucherId'] ?? ''),
            service: $data['service'] ?? null,
            origin: isset($data['origin']) && is_array($data['origin']) ? Location::fromArray($data['origin']) : null,
            destination: isset($data['destination']) && is_array($data['destination']) ? Location::fromArray($data['destination']) : null,
            status: isset($data['status']) && is_array($data['status']) ? Event::fromArray($data['status']) : null,
            serviceUrl: $data['serviceUrl'] ?? null,
            returnFlag: isset($data['returnFlag']) ? (bool) $data['returnFlag'] : null,
            details: isset($data['details']) && is_array($data['details']) ? $data['details'] : null,
            events: array_map(static fn(array $e) => Event::fromArray($e), $data['events'] ?? []),
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'service' => $this->service,
            'origin' => $this->origin?->toArray(),
            'destination' => $this->destination?->toArray(),
            'status' => $this->status?->toArray(),
            'serviceUrl' => $this->serviceUrl,
            'returnFlag' => $this->returnFlag,
            'details' => $this->details,
            'events' => array_map(static fn(Event $e) => $e->toArray(), $this->events),
        ], static fn($v) => $v !== null);
    }
}
