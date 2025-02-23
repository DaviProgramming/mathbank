<?php

namespace App\Enums\Transaction;

enum TransactionTypeEnum: string
{
    case SENT = 'sent';

    case RECEIVED = 'received';

    case REFUNDED = 'refunded';

    case CANCELED = 'canceled';

    case DEPOSIT = 'deposit';

    case WITHDRAW = 'withdraw';
}
