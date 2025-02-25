<?php

namespace Database\Factories\V1;

use App\Enums\Enums\Wallet\WalletTypeEnum;
use App\Models\V1\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => Carbon::now()->toString(),
            'document' => fake()->numerify('###.###.###-##'),
            'wallets_limit' => 2,
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
        ];
    }

    public function stateName(string $name): UserFactory
    {
        return $this->state([
            'name' => $name
        ]);
    }

    public function stateEmail(string $email): UserFactory
    {
        return $this->state([
            'email' => $email
        ]);
    }

    public function statePassword(string $password): UserFactory
    {
        return $this->state([
            'password' => Hash::make($password)
        ]);
    }

    public function stateDocument(string $document): UserFactory
    {
        return $this->state([
            'document' => $document
        ]);
    }

    public function stateWalletLimit(int $limit): UserFactory
    {
        return $this->state([
            'wallets_limit' => $limit
        ]);
    }

    public function stateWallet(WalletTypeEnum $type = null): UserFactory
    {
        return $this->afterCreating(function (User $user) use ($type) {
            WalletFactory::new()->stateType($type)->stateUser($user)->create();
        });
    }
}
