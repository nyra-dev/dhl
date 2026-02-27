<?php

namespace Nyra\Dhl\Dto;

use Nyra\Dhl\Auth\Token;

final readonly class AuthenticationResponse
{
    public function __construct(
        public Token  $token,
        public int    $walletBalance,
        public string $infoMessage,
        public string $externalCustomerId,
        public string $authenticatedUser
    ) {
    }

    public static function fromArray(array $data): self
    {
        $token = Token::fromArray($data);

        return new self(
            token: $token,
            walletBalance: (int) ($data['walletBalance'] ?? 0),
            infoMessage: (string) ($data['infoMessage'] ?? ''),
            externalCustomerId: (string) ($data['external_customer_id'] ?? ''),
            authenticatedUser: (string) ($data['authenticated_user'] ?? '')
        );
    }
}
