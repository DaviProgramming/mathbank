<?php

namespace App\Services\V1\Auth;

use App\Models\V1\User;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Enums\Wallet\CurrencysEnum;
use App\Enums\Wallet\WalletStatusEnum;

class AuthService
{
    protected User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function login(Collection $request): string
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        $token = JWTAuth::attempt($credentials);

        Str::of($token)->isNotEmpty() ?: throw new HttpException(Response::HTTP_BAD_REQUEST, 'Invalid credentials.');

        return $token;
    }

    public function register(Collection $request): User
    {
        $data = $request->all();

        $user = $this->user->create($data);

        $user
            ? $user->wallet()->create([
                'balance' => 0.0,
                'currency' => CurrencysEnum::BRL->value,
                'status' => WalletStatusEnum::ACTIVE->value,
            ])
            : throw new HttpException(Response::HTTP_BAD_GATEWAY, 'Failed to create user.');

        return $user;
    }
}
