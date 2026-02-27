<?php

namespace Nyra\Dhl\Auth;

/**
 * Credentials required for authentication.
 */
final readonly class Credentials
{
    public function __construct(
        public string  $clientId,
        public ?string $clientSecret = null,
        public ?string $username = null,
        public ?string $password = null,
    )
    {
        //
    }
}
