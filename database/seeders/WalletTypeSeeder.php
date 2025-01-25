<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\V1\WalletType;
use App\Enums\Enums\Wallet\WalletTypeEnum;

class WalletTypeSeeder extends Seeder
{
    public function run(): void
    {
        WalletType::insert([
            [
                'name' => 'Crypto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Foreign',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Local',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Digital',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
