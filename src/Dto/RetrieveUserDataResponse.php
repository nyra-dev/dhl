<?php

namespace Nyra\Dhl\Dto;

final readonly class RetrieveUserDataResponse
{
    public function __construct(
        public string  $invoiceType,
        public string  $invoiceFrequency,
        public string  $mail,
        public string  $country,
        public ?string $ekp = null,
        public ?string $company = null,
        public ?string $salutation = null,
        public ?string $title = null,
        public ?string $firstname = null,
        public ?string $lastname = null,
        public ?string $street = null,
        public ?string $houseNo = null,
        public ?string $zip = null,
        public ?string $city = null,
        public ?string $phone = null,
        public ?string $pobox = null,
        public ?string $poboxZip = null,
        public ?string $poboxCity = null,
        public ?string $epostbrief = null
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            invoiceType: (string) ($data['invoiceType'] ?? ''),
            invoiceFrequency: (string) ($data['invoiceFrequency'] ?? ''),
            mail: (string) ($data['mail'] ?? ''),
            country: (string) ($data['country'] ?? ''),
            ekp: $data['ekp'] ?? null,
            company: $data['company'] ?? null,
            salutation: $data['salutation'] ?? null,
            title: $data['title'] ?? null,
            firstname: $data['firstname'] ?? null,
            lastname: $data['lastname'] ?? null,
            street: $data['street'] ?? null,
            houseNo: $data['houseNo'] ?? null,
            zip: $data['zip'] ?? null,
            city: $data['city'] ?? null,
            phone: $data['phone'] ?? null,
            pobox: $data['pobox'] ?? null,
            poboxZip: $data['poboxZip'] ?? null,
            poboxCity: $data['poboxCity'] ?? null,
            epostbrief: $data['epostbrief'] ?? null
        );
    }
}
