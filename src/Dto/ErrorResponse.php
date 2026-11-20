<?php

namespace Nyra\Dhl\Dto;

final readonly class ErrorResponse
{
    public function __construct(
        public string $statusCode,
        public string $title,
        public string $description
    ) {
    }

    /**
     * DHL's APIs do not all answer errors alike: the INTERNETMARKE API uses
     * `statusCode`, `title` and `description`, the API gateway and others use
     * RFC 7807 problem details (`status`, `title`, `detail`) or a `message`.
     * Each field takes the first of its names that is set and not empty.
     *
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            statusCode: self::first($data, ['statusCode', 'status', 'code']),
            title: self::first($data, ['title', 'error']),
            description: self::first($data, ['description', 'detail', 'message', 'error_description'])
        );
    }

    /**
     * @param array<mixed> $data
     * @param list<string> $keys
     */
    private static function first(array $data, array $keys): string
    {
        foreach ($keys as $key) {
            $value = $data[$key] ?? null;

            if (is_scalar($value) && trim((string) $value) !== '') {
                return trim((string) $value);
            }
        }

        return '';
    }
}
