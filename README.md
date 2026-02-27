# DHL PHP Client

## Install

```bash
composer require nyra/dhl
```

## Usage

Quick start:

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use Nyra\Dhl\Auth\Credentials;
use Nyra\Dhl\DhlClient;
use Nyra\Dhl\Dto\Address;
use Nyra\Dhl\Dto\AddressBinding;
use Nyra\Dhl\Dto\ShoppingCartPDFPosition;
use Nyra\Dhl\Dto\LabelPdfRequest;
use Nyra\Dhl\Dto\VoucherLayout;
use Nyra\Dhl\Dto\VoucherPosition;

// Create client with your credentials (use environment vars in production)
$dhl = DhlClient::create(
    credentials: new Credentials(
        clientId: 'your-client-id',
        clientSecret: 'your-client-secret',
        username: 'your-username',
        password: 'your-password'
    ),
);

// Retrieve tracking information for a shipment
$tracking = $dhl->tracking->shipments->retrieve([
    'trackingNumber' => '000000000000000000000',
]);

// Create an Internetmarke shopping cart
$shoppingCart = $dhl->internetmarke->shoppingCart->create();

// Checkout a PDF with positions from the shopping cart
$response = $dhl->internetmarke->labels->checkoutPdf(
    request: new LabelPdfRequest(
        total: 5,
        positions: [
            new ShoppingCartPDFPosition(
                productCode: 298,
                voucherLayout: VoucherLayout::ADDRESS_ZONE,
                position: new VoucherPosition(labelX: 1, labelY: 1, page: 1),
                address: new AddressBinding(
                    sender: new Address(
                        name: 'Max Mustermann',
                        addressLine1: 'Postfach 12345',
                        city: 'Bonn',
                        postalCode: '53056',
                        country: 'DEU',
                        additionalName: 'Example Sender Ltd.'
                    ),
                    receiver: new Address(
                        name: 'Max Mustermann',
                        addressLine1: 'Musterstraße 1',
                        city: 'Musterstadt',
                        postalCode: '12345',
                        country: 'DEU'
                    )
                )
            )
        ],
        shopOrderId: $shoppingCart->shopOrderId,
        pageFormatId: 77,
    )
);

print_r($response);
```

## Testing

```bash
composer test
```

## Notes

- HTTP client defaults to Guzzle via PSR-18; you can pass any PSR-18 client and PSR-16-like token cache implementing `TokenCacheInterface`.
- Error responses are thrown as `ApiException` with parsed error payload when status code >= 400.
