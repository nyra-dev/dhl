<?php

namespace Nyra\Dhl;

use GuzzleHttp\Client as GuzzleClient;
use Nyra\Dhl\Auth\Authenticator;
use Nyra\Dhl\Auth\InMemoryTokenCache;
use Nyra\Dhl\Http\JsonHttpClient;
use Nyra\Dhl\Resource\Internetmarke as InternetmarkeResource;
use Nyra\Dhl\Resource\Tracking as TrackingResource;

readonly class DhlClient
{
    public Authenticator $auth;
    public Internetmarke $internetmarke;
    public Tracking $tracking;

    public function __construct(
        Config                        $config,
        protected ?GuzzleClient       $httpClient = null,
        protected ?InMemoryTokenCache $tokenCache = null,
    )
    {
        $httpClient ??= new GuzzleClient();
        $tokenCache ??= new InMemoryTokenCache();
        $internetmarkeHttp = new JsonHttpClient(
            client: $httpClient,
            baseUrl: 'https://api-eu.dhl.com/post/de/shipping/im/v1',
            config: $config,
        );
        $this->auth = new Authenticator($config->credentials, $internetmarkeHttp, $tokenCache);

        $this->internetmarke = new Internetmarke(
            apiVersion: new InternetmarkeResource\ApiVersionResource($internetmarkeHttp, $this->auth),
            catalogue: new InternetmarkeResource\CatalogueResponse($internetmarkeHttp, $this->auth),
            labels: new InternetmarkeResource\LabelsResource($internetmarkeHttp, $this->auth),
            retoure: new InternetmarkeResource\RetoureResource($internetmarkeHttp, $this->auth),
            shoppingCart: new InternetmarkeResource\ShoppingCartResponse($internetmarkeHttp, $this->auth),
            user: new InternetmarkeResource\UserResource($internetmarkeHttp, $this->auth),
            wallet: new InternetmarkeResource\WalletResource($internetmarkeHttp, $this->auth),
        );

        $trackingHttp = new JsonHttpClient(
            client: $httpClient,
            baseUrl: 'https://api-eu.dhl.com/track',
            config: $config,
        );

        $this->tracking = new Tracking(
            shipments: new TrackingResource\ShipmentsResource($trackingHttp, $this->auth),
        );
    }

    public static function create(
        Auth\Credentials $credentials = null,
        int              $timeout = 30,
    ): DhlClient
    {
        return new self(new Config(
            credentials: $credentials,
            timeout: $timeout,
        ));
    }
}