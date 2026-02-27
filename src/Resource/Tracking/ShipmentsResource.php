<?php

namespace Nyra\Dhl\Resource\Tracking;

use Nyra\Dhl\Resource\BaseResource;
use Nyra\Dhl\Dto\TrackingShipments;

final class ShipmentsResource extends BaseResource
{
    public function retrieve(array $query): TrackingShipments
    {
        $data = $this->decode($this->http->get('/shipments', $query, [
            'DHL-API-Key' => $this->auth->credentials->clientId,
        ]));

        return TrackingShipments::fromArray($data);
    }
}
