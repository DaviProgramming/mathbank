<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;
use App\Observers\V1\TransactionObserver;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([TransactionObserver::class])]
class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'wallet_id',
        'wallet_id_transfer',
        'amount',
        'type',
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function walletTransfer(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'wallet_id_transfer', 'id');
    }
}
