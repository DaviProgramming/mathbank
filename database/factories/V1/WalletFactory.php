<?php

namespace Database\Factories\V1;

use App\Models\V1\User;
use App\Models\V1\Wallet;
use App\Enums\Wallet\CurrencysEnum;
use App\Enums\Wallet\WalletStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    protected $model = Wallet::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'balance' => 0.0,
            'currency' => CurrencysEnum::BRL->value,
            'status' => WalletStatusEnum::ACTIVE->value,
        ];
    }
}
