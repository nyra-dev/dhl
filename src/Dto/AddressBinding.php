<?php

namespace Nyra\Dhl\Dto;

final readonly class AddressBinding
{
    public function __construct(public Address $sender, public Address $receiver)
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            sender: Address::fromArray($data['sender'] ?? []),
            receiver: Address::fromArray($data['receiver'] ?? [])
        );
    }

    public function toArray(): array
    {
        return [
            'sender' => $this->sender->toArray(),
            'receiver' => $this->receiver->toArray(),
        ];
    }
}
