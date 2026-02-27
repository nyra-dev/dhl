<?php

namespace Nyra\Dhl\Auth;

use Nyra\Dhl\Dto\AuthenticationResponse;
use Nyra\Dhl\Http\JsonHttpClient;
use Nyra\Dhl\Http\ResponseHandler;

final readonly class Authenticator
{
    public function __construct(
        public Credentials          $credentials,
        private JsonHttpClient      $http,
        private TokenCacheInterface $cache
    ) {
    }

    public function getToken(): Token
    {
        $cached = $this->cache->get();
        if ($cached instanceof Token && !$cached->isExpired()) {
            return $cached;
        }

        $fresh = $this->requestToken();
        $this->cache->set($fresh->token);

        return $fresh->token;
    }

    public function authorize(): AuthenticationResponse
    {
        $response = $this->requestToken();
        $this->cache->set($response->token);

        return $response;
    }

    private function requestToken(): AuthenticationResponse
    {
        $payload = [
            'grant_type' => 'client_credentials',
            'client_id' => $this->credentials->clientId,
            'client_secret' => $this->credentials->clientSecret,
            'username' => $this->credentials->username,
            'password' => $this->credentials->password,
        ];

        $response = $this->http->postForm('/user', $payload);
        $data = ResponseHandler::decodeOrThrow($response);

        return AuthenticationResponse::fromArray($data);
    }
}
