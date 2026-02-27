<?php

namespace Nyra\Dhl;

use Nyra\Dhl\Resource\Internetmarke\ApiVersionResource;
use Nyra\Dhl\Resource\Internetmarke\CatalogueResponse;
use Nyra\Dhl\Resource\Internetmarke\LabelsResource;
use Nyra\Dhl\Resource\Internetmarke\RetoureResource;
use Nyra\Dhl\Resource\Internetmarke\ShoppingCartResponse;
use Nyra\Dhl\Resource\Internetmarke\UserResource;
use Nyra\Dhl\Resource\Internetmarke\WalletResource;

readonly class Internetmarke
{
    public function __construct(
        public ApiVersionResource   $apiVersion,
        public CatalogueResponse    $catalogue,
        public LabelsResource       $labels,
        public RetoureResource      $retoure,
        public ShoppingCartResponse $shoppingCart,
        public UserResource         $user,
        public WalletResource       $wallet,
    )
    {
        //
    }
}