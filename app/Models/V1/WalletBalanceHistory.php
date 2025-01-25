<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WalletBalanceHistory extends Model
{
    protected $table = "wallets_balance_history";

    protected $fillable = [
        'wallet_id',
        'balance',
        'recorded_at'
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'id', 'wallet_id');
    }
}
