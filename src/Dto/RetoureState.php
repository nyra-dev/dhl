<?php

namespace Nyra\Dhl\Dto;

/**
 * Status information for submitted refund.
 */
final readonly class RetoureState
{
    /** @param list<Voucher> $refundedVouchers @param list<Voucher> $notRefundedVouchers */
    public function __construct(
        public string $shopRetoureId,
        public string $serialNumber,
        public string $creationDate,
        public array  $refundedVouchers,
        public array  $notRefundedVouchers,
        public ?int   $retoureTransactionId = null,
        public ?int   $totalCount = null,
        public ?int   $countStillOpen = null,
        public ?int   $retourePrice = null
    ) {
    }

    public static function fromArray(array $data): self
    {
        $refunded = array_map(static fn(array $item) => Voucher::fromArray($item), $data['refundedVouchers'] ?? []);
        $notRefunded = array_map(static fn(array $item) => Voucher::fromArray($item), $data['notRefundedVouchers'] ?? []);

        return new self(
            shopRetoureId: (string) ($data['shopRetoureId'] ?? ''),
            serialNumber: (string) ($data['serialnumber'] ?? ''),
            creationDate: (string) ($data['creationDate'] ?? ''),
            refundedVouchers: $refunded,
            notRefundedVouchers: $notRefunded,
            retoureTransactionId: isset($data['retoureTransactionId']) ? (int) $data['retoureTransactionId'] : null,
            totalCount: isset($data['totalCount']) ? (int) $data['totalCount'] : null,
            countStillOpen: isset($data['countStillOpen']) ? (int) $data['countStillOpen'] : null,
            retourePrice: isset($data['retourePrice']) ? (int) $data['retourePrice'] : null
        );
    }
}
