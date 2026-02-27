<?php

namespace Nyra\Dhl\Resource;

use Nyra\Dhl\Auth\Authenticator;
use Nyra\Dhl\Http\JsonHttpClient;
use Nyra\Dhl\Http\ResponseHandler;
use Psr\Http\Message\ResponseInterface;

abstract class BaseResource
{
    public function __construct(
        protected readonly JsonHttpClient $http,
        protected readonly Authenticator $auth
    ) {
    }

    /** @param array<string,string|int|bool> $query */
    protected function get(string $path, array $query = []): ResponseInterface
    {
        $headers = $this->bearerHeader();

        return $this->http->get($path, $query, $headers);
    }

    /** @param array<string,string|int|bool> $query */
    protected function getPublic(string $path, array $query = []): ResponseInterface
    {
        return $this->http->get($path, $query);
    }

    /**
     * @param array<string,string|int|bool> $query
     * @param array<string,mixed>|null $json
     */
    protected function post(string $path, array $query = [], ?array $json = null): ResponseInterface
    {
        $headers = $this->bearerHeader();

        return $this->http->post($path, $query, $json, $headers);
    }

    /**
     * @param array<string,string|int|bool> $query
     * @param array<string,mixed>|null $json
     */
    protected function put(string $path, array $query = [], ?array $json = null): ResponseInterface
    {
        $headers = $this->bearerHeader();

        return $this->http->put($path, $query, $json, $headers);
    }

    /**
     * @return array<string,string>
     */
    protected function bearerHeader(): array
    {
        $token = $this->auth->getToken();

        return [
            'Authorization' => sprintf('Bearer %s', $token->accessToken),
        ];
    }

    /**
     * @return array<string,mixed>
     */
    protected function decode(ResponseInterface $response): array
    {
        return ResponseHandler::decodeOrThrow($response);
    }
}
