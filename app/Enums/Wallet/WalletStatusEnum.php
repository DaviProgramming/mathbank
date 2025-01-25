<?php

namespace App\Enums\Wallet;

enum WalletStatusEnum: string
{
    case ACTIVE = 'active';

    case INACTIVE = 'inactive';

    case SUSPENDED = 'suspended';

    case CLOSED = 'closed';
}
