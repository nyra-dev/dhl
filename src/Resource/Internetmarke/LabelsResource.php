<?php

namespace Nyra\Dhl\Resource\Internetmarke;

use Nyra\Dhl\Resource\BaseResource;
use Nyra\Dhl\Dto\CheckoutShoppingCartResponse;
use Nyra\Dhl\Dto\LabelPdfRequest;
use Nyra\Dhl\Dto\LabelPngRequest;
use Nyra\Dhl\Dto\LabelPreviewPdfRequest;
use Nyra\Dhl\Dto\LabelPreviewPngRequest;

final class LabelsResource extends BaseResource
{
    public function checkoutPng(
        LabelPngRequest|LabelPreviewPngRequest $request,
        bool                                   $validate = false,
        bool                                   $directCheckout = false
    ): CheckoutShoppingCartResponse
    {
        $query = [];
        if ($validate) {
            $query['validate'] = true;
        }
        if ($directCheckout) {
            $query['directCheckout'] = true;
        }

        $data = $this->decode($this->post('/app/shoppingcart/png', $query, $request->toArray()));

        return CheckoutShoppingCartResponse::fromArray($data);
    }

    public function checkoutPdf(
        LabelPdfRequest|LabelPreviewPdfRequest $request,
        bool                                   $validate = false,
        bool                                   $directCheckout = false
    ): CheckoutShoppingCartResponse
    {
        $query = [];
        if ($validate) {
            $query['validate'] = true;
        }
        if ($directCheckout) {
            $query['directCheckout'] = true;
        }

        $data = $this->decode($this->post('/app/shoppingcart/pdf', $query, $request->toArray()));

        return CheckoutShoppingCartResponse::fromArray($data);
    }
}
