<?php

namespace App\Services\V1\Auth;

use App\Models\V1\User;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        return $this->user->create($request->all());
    }

    public function refreshToken($token): string
    {
        $newToken = JWTAuth::refresh($token);

        return $newToken;
    }
}
