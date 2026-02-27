<?php

namespace Nyra\Dhl\Auth;

final class InMemoryTokenCache implements TokenCacheInterface
{
    private ?Token $token = null;

    public function get(): ?Token
    {
        return $this->token;
    }

    public function set(Token $token): void
    {
        $this->token = $token;
    }
}
