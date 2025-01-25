<?php

namespace App\Models\V1;

use App\Enums\Wallet\CurrencysEnum;
use App\Enums\Wallet\WalletStatusEnum;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Enums\Wallet\WalletTypeEnum;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    protected $table = "wallets";

    protected $fillable = [
        'user_id',
        'wallet_type_id',
        'balance',
        'currency',
        'status',
        'deleted_at'
    ];

    protected $attributes = [
        'wallet_type_id' => WalletTypeEnum::LOCAL->value,
        'balance' => 0.0,
        'currency' => CurrencysEnum::BRL->value,
        'status' => WalletStatusEnum::ACTIVE->value,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function type(): HasOne
    {
        return $this->hasOne(WalletType::class, 'id', 'wallet_type_id');
    }

    public function balanceHistory(): HasMany
    {
        return $this->hasMany(WalletBalanceHistory::class, 'wallet_id', 'id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'wallet_id', 'id');
    }
}
