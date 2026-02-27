<?php

namespace Nyra\Dhl\Auth;

interface TokenCacheInterface
{
    public function get(): ?Token;

    public function set(Token $token): void;
}
