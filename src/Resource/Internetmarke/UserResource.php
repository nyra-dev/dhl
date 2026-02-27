<?php

namespace Nyra\Dhl\Resource\Internetmarke;

use Nyra\Dhl\Resource\BaseResource;
use Nyra\Dhl\Dto\AuthenticationResponse;
use Nyra\Dhl\Dto\RetrieveUserDataResponse;

final class UserResource extends BaseResource
{
    public function authorize(): AuthenticationResponse
    {
        return $this->auth->authorize();
    }

    public function profile(): RetrieveUserDataResponse
    {
        $data = $this->decode($this->get('/user/profile'));

        return RetrieveUserDataResponse::fromArray($data);
    }
}
