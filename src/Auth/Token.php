<?php

namespace Nyra\Dhl\Auth;

use DateInterval;
use DateTimeImmutable;

/**
 * Access token with expiry handling.
 */
final readonly class Token
{
    public function __construct(
        public string            $accessToken,
        public string            $tokenType,
        public int               $expiresIn,
        public DateTimeImmutable $issuedAt
    ) {
    }

    public static function fromArray(array $payload): self
    {
        $issuedAtRaw = $payload['issued_at'] ?? 'now';
        $issuedAt = $issuedAtRaw instanceof DateTimeImmutable
            ? $issuedAtRaw
            : new DateTimeImmutable(is_string($issuedAtRaw) ? $issuedAtRaw : 'now');

        return new self(
            accessToken: (string) ($payload['access_token'] ?? ''),
            tokenType: (string) ($payload['tokenType'] ?? $payload['token_type'] ?? 'BearerToken'),
            expiresIn: (int) ($payload['expires_in'] ?? 0),
            issuedAt: $issuedAt
        );
    }

    public function isExpired(int $leewaySeconds = 30): bool
    {
        $expiry = $this->issuedAt->add(new DateInterval('PT' . max($this->expiresIn, 0) . 'S'));

        return $expiry->getTimestamp() - $leewaySeconds <= (new DateTimeImmutable())->getTimestamp();
    }
}
