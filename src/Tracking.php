<?php

namespace Nyra\Dhl;

use Nyra\Dhl\Resource\Tracking\ShipmentsResource;

class Tracking
{
    public function __construct(
        public ShipmentsResource $shipments,
    )
    {
        //
    }
}