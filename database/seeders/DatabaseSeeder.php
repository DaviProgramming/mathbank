<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            WalletTypeSeeder::class,
        ]);
    }
}
