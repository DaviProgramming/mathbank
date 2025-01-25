<?php

namespace App\Enums\Enums\Wallet;

enum WalletTypeEnum: int
{
    case CRYPTO = 1;

    case FOREIGN = 2;

    case LOCAL = 3;

    case DIGITAL = 4;
}
