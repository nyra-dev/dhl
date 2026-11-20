<?php

namespace Nyra\Dhl\Http;

use Nyra\Dhl\Dto\ErrorResponse;
use RuntimeException;
use Throwable;

final class ApiException extends RuntimeException
{
    /**
     * @param string|null $body the raw response body, for logging
     */
    public function __construct(
        public readonly int $statusCode,
        public readonly ?ErrorResponse $error = null,
        string $message = '',
        ?Throwable $previous = null,
        public readonly ?string $body = null
    ) {
        parent::__construct($message !== '' ? $message : self::describe($statusCode, $error, $body), $statusCode, $previous);
    }

    /**
     * The error's description, else its title, else the start of the body,
     * so the message is never empty.
     */
    private static function describe(int $statusCode, ?ErrorResponse $error, ?string $body): string
    {
        if ($error !== null && $error->description !== '') {
            return $error->description;
        }

        if ($error !== null && $error->title !== '') {
            return $error->title;
        }

        $text = trim((string) preg_replace('/\s+/', ' ', strip_tags((string) $body)));

        if ($text !== '') {
            // the first 200 characters, cut between UTF-8 characters
            return preg_match('/^.{200}(?=.)/su', $text, $start) === 1 ? $start[0].'…' : $text;
        }

        return sprintf('API error (HTTP %d)', $statusCode);
    }
}
