<?php

namespace Database\Factories\V1;

use App\Models\V1\User;
use App\Models\V1\Wallet;
use App\Enums\Wallet\CurrencysEnum;
use App\Enums\Wallet\WalletStatusEnum;
use Database\Factories\V1\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\Enums\Wallet\WalletTypeEnum;

class WalletFactory extends Factory
{
    protected $model = Wallet::class;

    public function definition(): array
    {
        return [
            'user_id' => UserFactory::new(),
            'wallet_type_id' => WalletTypeEnum::LOCAL->value,
            'balance' => 0.0,
            'currency' => CurrencysEnum::BRL->value,
            'status' => WalletStatusEnum::ACTIVE->value,
        ];
    }

    public function stateUser(User | UserFactory | int $id): WalletFactory
    {
        return $this->state([
            'user_id' => $id
        ]);
    }

    public function stateType(WalletTypeEnum $type): WalletFactory
    {
        return $this->state([
            'wallet_type_id' => $type->value,
        ]);
    }

    public function stateBalance(float $balance): WalletFactory
    {
        return $this->state([
            'balance' => $balance
        ]);
    }

    public function stateCurrency(CurrencysEnum $currency): WalletFactory
    {
        return $this->state([
            'currency' => $currency->value
        ]);
    }

    public function stateStatus(WalletStatusEnum $status): WalletFactory
    {
        return $this->state([
            'status' => $status->value
        ]);
    }
}
