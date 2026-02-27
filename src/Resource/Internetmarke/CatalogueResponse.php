<?php

namespace Nyra\Dhl\Resource\Internetmarke;

use Nyra\Dhl\Resource\BaseResource;
use Nyra\Dhl\Dto\RetrieveCatalogResponse;

final class CatalogueResponse extends BaseResource
{
    /**
     * Retrieves the catalog of available products and services for the authenticated user.
     */
    public function retrieve(string $types): RetrieveCatalogResponse
    {
        $data = $this->decode($this->get('/app/catalog', ['types' => $types]));

        return RetrieveCatalogResponse::fromArray($data);
    }
}
