<?php

namespace Tests\Feature\V1\Http\Controllers;

use Tests\TestCase;
use App\Models\V1\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Database\Factories\V1\UserFactory;
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

        $response->assertStatus(Response::HTTP_OK);

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

        $response->assertStatus(Response::HTTP_OK);

        $jwtToken = $response->json('data');

        $payload = JWTAuth::setToken($jwtToken)->getPayload()->toArray();

        $this->assertTrue($payload['sub'] == $user['id']);
    }

    public function test_refresh_token(): void
    {
        $user = UserFactory::new()->create();

        $response = $this->actingAsUser()->postJson("$this->url/refresh-token");

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonStructure([
            'message',
            'data'
        ]);
    }
}
