<?php

namespace App\Enums\Transaction;

enum TransactionTypeEnum: string
{
    case SENT = 'sent';

    case RECEIVED = 'received';

    case REFUNDED = 'refunded';

    case CANCELED = 'canceled';
}
