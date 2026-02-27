<?php

namespace Nyra\Dhl\Http;

use Nyra\Dhl\Dto\ErrorResponse;
use RuntimeException;
use Throwable;

final class ApiException extends RuntimeException
{
    public function __construct(
        public readonly int $statusCode,
        public readonly ?ErrorResponse $error = null,
        string $message = '',
        ?Throwable $previous = null
    ) {
        parent::__construct($message !== '' ? $message : ($error?->description ?? 'API error'), $statusCode, $previous);
    }
}
