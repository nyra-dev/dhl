<?php

namespace Nyra\Dhl;

use Nyra\Dhl\Auth\Credentials;

/**
 * Client configuration value object.
 */
final readonly class Config
{
    public function __construct(
        public Credentials $credentials,
        public string      $userAgent = 'nyra-dhl/1.0',
        public int         $timeout = 30,
    )
    {
    }
}
