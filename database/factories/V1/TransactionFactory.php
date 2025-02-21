<?php

namespace Database\Factories\V1;

use App\Models\V1\Wallet;
use App\Models\V1\Transaction;
use App\Enums\Transaction\TransactionTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'wallet_id' => WalletFactory::new()->create()->id,
            'amount' => $this->faker->randomFloat(2, 0, 1000),
            'type' => $this->faker->randomElement(TransactionTypeEnum::cases())->value,
            'wallet_id_transfer' => WalletFactory::new()->create()->id,
        ];
    }

    public function stateWallet(Wallet | int $wallet): TransactionFactory
    {
        return $this->state([
            'wallet_id' => $wallet->id,
        ]);
    }

    public function stateAmount(float $amount): TransactionFactory
    {
        return $this->state([
            'amount' => $amount,
        ]);
    }

    public function stateType(TransactionTypeEnum $type): TransactionFactory
    {
        return $this->state([
            'type' => $type->value,
        ]);
    }

    public function stateWalletTransfer(Wallet | int $wallet): TransactionFactory
    {
        return $this->state([
            'wallet_id_transfer' => $wallet->id,
        ]);
    }
}
