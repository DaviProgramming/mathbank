<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WalletType extends Model
{
    protected $table = "type_wallets";

    protected $fillable = [
        'balance',
        'recorded_at'
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'wallet_type_id', 'id');
    }
}
