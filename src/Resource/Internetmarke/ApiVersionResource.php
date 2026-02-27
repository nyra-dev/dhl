<?php

namespace Nyra\Dhl\Resource\Internetmarke;

use Nyra\Dhl\Resource\BaseResource;
use Nyra\Dhl\Dto\ApiVersionResponse;

final class ApiVersionResource extends BaseResource
{
    public function version(): ApiVersionResponse
    {
        $data = $this->decode($this->getPublic('/'));
        $payload = $data['amp'] ?? $data;

        return ApiVersionResponse::fromArray($payload);
    }
}
