<?php

namespace Nyra\Dhl\Http;

use GuzzleHttp\Psr7\Request;
use Nyra\Dhl\Config;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Thin HTTP wrapper that handles base URI, headers, and JSON / form encoding.
 */
final class JsonHttpClient
{
    private readonly string $baseUri;
    /** @var array<string,string> */
    private array $defaultHeaders;

    public function __construct(
        private readonly ClientInterface $client,
        private readonly string $baseUrl,
        Config $config
    ) {
        $this->baseUri = rtrim($baseUrl, '/');
        $this->defaultHeaders = [
            'User-Agent' => $config->userAgent,
            'Accept' => 'application/json',
        ];
    }

    /**
     * @param array<string,string|int|bool> $query
     * @param array<string,string> $headers
     */
    public function get(string $path, array $query = [], array $headers = []): ResponseInterface
    {
        return $this->send('GET', $path, $query, null, $headers);
    }

    /**
     * @param array<string,string|int|bool> $query
     * @param array<string,mixed>|null $json
     * @param array<string,string> $headers
     */
    public function post(string $path, array $query = [], ?array $json = null, array $headers = []): ResponseInterface
    {
        return $this->send('POST', $path, $query, $json, $headers, 'application/json');
    }

    /**
     * @param array<string,string|int|bool> $query
     * @param array<string,mixed>|null $json
     * @param array<string,string> $headers
     */
    public function put(string $path, array $query = [], ?array $json = null, array $headers = []): ResponseInterface
    {
        return $this->send('PUT', $path, $query, $json, $headers, 'application/json');
    }

    /**
     * Sends a form-encoded POST request.
     *
     * @param array<string,string> $formParams
     * @param array<string,string> $headers
     */
    public function postForm(string $path, array $formParams, array $headers = []): ResponseInterface
    {
        return $this->send('POST', $path, [], $formParams, $headers, 'application/x-www-form-urlencoded');
    }

    /**
     * @param array<string,string|int|bool> $query
     * @param array<string,mixed>|null $payload
     * @param array<string,string> $headers
     */
    private function send(
        string $method,
        string $path,
        array $query = [],
        ?array $payload = null,
        array $headers = [],
        ?string $contentType = null
    ): ResponseInterface {
        $uri = $this->buildUri($path, $query);
        $body = null;

        if ($payload !== null) {
            if ($contentType === 'application/json') {
                $body = json_encode($payload, JSON_THROW_ON_ERROR);
            } elseif ($contentType === 'application/x-www-form-urlencoded') {
                $body = http_build_query($payload);
            }
        }

        $mergedHeaders = array_merge($this->defaultHeaders, $headers);
        if ($contentType !== null) {
            $mergedHeaders['Content-Type'] = $contentType;
        }

        $request = new Request($method, $uri, $mergedHeaders, $body);

        return $this->client->sendRequest($request);
    }

    /**
     * @param array<string,string|int|bool> $query
     */
    private function buildUri(string $path, array $query): string
    {
        $uri = $this->baseUri . '/' . ltrim($path, '/');

        if ($query !== []) {
            $uri .= '?' . http_build_query($query);
        }

        return $uri;
    }
}
