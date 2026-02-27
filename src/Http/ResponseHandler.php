<?php

namespace Nyra\Dhl\Http;

use Nyra\Dhl\Dto\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

final class ResponseHandler
{
    /**
     * @return array<string,mixed>
     */
    public static function decode(ResponseInterface $response): array
    {
        $body = (string) $response->getBody();
        if ($body === '') {
            return [];
        }

        return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @return array<string,mixed>
     */
    public static function decodeOrThrow(ResponseInterface $response): array
    {
        $status = $response->getStatusCode();
        $data = self::decode($response);

        if ($status >= 400) {
            $error = $data !== [] ? ErrorResponse::fromArray($data) : null;
            throw new ApiException($status, $error);
        }

        return $data;
    }
}
