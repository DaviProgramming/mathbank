<?php

namespace Tests\Feature\V1\Http\Controllers;

use Tests\TestCase;
use App\Models\V1\User;
use Illuminate\Support\Arr;
use Tymon\JWTAuth\Facades\JWTAuth;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected string $url = "api/v1/auth";

    public function test_register(): void
    {
        $user = UserFactory::new()->make()->toArray();

        Arr::set($user, 'password', "password123");

        $response = $this->postJson("$this->url/register", $user);

        $response->assertStatus(200);

        $userCreated = User::find($response['data']['id']);

        $this->assertModelExists($userCreated);

        $userWalletCreated = $userCreated->wallet()->first();

        $this->assertModelExists($userWalletCreated);
    }

    public function test_login(): void
    {
        $user = UserFactory::new()->create()->toArray();

        Arr::set($user, 'password', "password123");

        $response = $this->postJson("$this->url/login", $user);

        $response->assertStatus(200);

        $jwtToken = $response->json('data');

        $payload = JWTAuth::setToken($jwtToken)->getPayload()->toArray();

        $this->assertTrue($payload['sub'] == $user['id']);
    }

    public function test_refresh_token(): void
    {
        $user = UserFactory::new()->create();

        $credentials = [
            'email' => $user->email,
            'password' => "password123"
        ];

        $token = JWTAuth::attempt($credentials);

        $response = $this->withHeader('Authorization', "Bearer $token")->postJson("$this->url/refresh-token");

        dd($response->json());
    }
}
