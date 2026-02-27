<?php

namespace Nyra\Dhl\Dto;

final readonly class CheckoutShoppingCartResponse
{
    public function __construct(
        public string       $link,
        public ?string      $manifestLink,
        public ShoppingCart $shoppingCart,
        public ?int         $walletBalance,
        public string       $type
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            link: (string) ($data['link'] ?? ''),
            manifestLink: isset($data['manifestLink']) ? (string) $data['manifestLink'] : null,
            shoppingCart: ShoppingCart::fromArray($data['shoppingCart'] ?? []),
            walletBalance: isset($data['walletBallance']) ? (int) $data['walletBallance'] : null,
            type: (string) ($data['type'] ?? '')
        );
    }
}
