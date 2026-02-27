<?php

namespace Nyra\Dhl\Resource\Internetmarke;

use Nyra\Dhl\Resource\BaseResource;
use Nyra\Dhl\Dto\RetoureVouchersRequest;
use Nyra\Dhl\Dto\RetoureVouchersResponse;
use Nyra\Dhl\Dto\RetrieveRetoureStateResponse;

final class RetoureResource extends BaseResource
{
    public function create(RetoureVouchersRequest $request): RetoureVouchersResponse
    {
        $data = $this->decode($this->post('/app/retoure', [], $request->toArray()));

        return RetoureVouchersResponse::fromArray($data);
    }

    public function retrieve(
        ?string $shopRetoureId = null,
        ?int    $retoureTransactionId = null,
        ?string $startDate = null,
        ?string $endDate = null
    ): RetrieveRetoureStateResponse
    {
        $query = array_filter([
            'shopRetoureId' => $shopRetoureId,
            'retoureTransactionId' => $retoureTransactionId,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ], static fn($v) => $v !== null && $v !== '');

        $data = $this->decode($this->get('/app/retoure', $query));

        return RetrieveRetoureStateResponse::fromArray($data);
    }
}
