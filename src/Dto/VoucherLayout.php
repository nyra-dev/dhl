<?php

namespace Nyra\Dhl\Dto;

enum VoucherLayout: string
{
    case ADDRESS_ZONE = 'ADDRESS_ZONE';
    case FRANKING_ZONE = 'FRANKING_ZONE';
}
