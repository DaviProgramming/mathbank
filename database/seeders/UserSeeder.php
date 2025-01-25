<?php

namespace Database\Seeders;

use Database\Factories\V1\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        UserFactory::new()->count(10)->create();
    }
}
