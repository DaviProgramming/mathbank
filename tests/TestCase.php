<?php

namespace Tests;

use App\Models\V1\User;
use Database\Factories\V1\UserFactory;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function actingAsUser(?User $user = null)
    {
        $admin = $user ?? UserFactory::new()->create();

        $token = JWTAuth::fromUser($admin);

        $this->withHeaders([
            'Authorization' => "Bearer $token"
        ]);

        return $this;
    }
}
