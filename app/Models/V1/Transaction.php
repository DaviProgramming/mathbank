<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $table = "transactions";

    protected $fillable = [
        'wallet_id',
        'amount',
        'type',
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'id', 'wallet_id');
    }
}
