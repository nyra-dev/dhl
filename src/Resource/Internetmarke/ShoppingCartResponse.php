<?php

namespace Nyra\Dhl\Resource\Internetmarke;

use Nyra\Dhl\Resource\BaseResource;
use Nyra\Dhl\Dto\CheckoutShoppingCartAppResponse;
use Nyra\Dhl\Dto\InitShoppingCartResponse;

final class ShoppingCartResponse extends BaseResource
{
    /**
     * Initializes a new shopping cart session and returns the session details.
     */
    public function create(): InitShoppingCartResponse
    {
        $data = $this->decode($this->post('/app/shoppingcart'));

        return InitShoppingCartResponse::fromArray($data);
    }

    /**
     * Retrieves the details of a shopping cart session using the provided shop order ID.
     */
    public function retrieve(string $shopOrderId): CheckoutShoppingCartAppResponse
    {
        $data = $this->decode($this->get(sprintf('/app/shoppingcart/%s', $shopOrderId)));

        return CheckoutShoppingCartAppResponse::fromArray($data);
    }
}
