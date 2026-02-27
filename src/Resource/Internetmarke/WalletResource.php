<?php

namespace Nyra\Dhl\Resource\Internetmarke;

use Nyra\Dhl\Resource\BaseResource;
use Nyra\Dhl\Dto\ChargeWalletResponse;

final class WalletResource extends BaseResource
{
    /**
     * Charges the user's wallet with the specified amount.
     */
    public function charge(int $amount): ChargeWalletResponse
    {
        $data = $this->decode($this->put('/app/wallet', ['amount' => $amount]));

        return ChargeWalletResponse::fromArray($data);
    }
}
