<?php

namespace App\Enums;

enum AddressTypeEnum: int
{
    /**
     * Type of address.
     */
    case MAIN = 0;
    case SECONDARY = 1;
}
