<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\V1\Auth\AuthService;
use App\Http\Resources\V1\Auth\UserResource;
use App\Http\Requests\V1\Auth\UserLoginRequest;
use App\Http\Requests\V1\Auth\UserRegisterRequest;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function login(UserLoginRequest $request): JsonResponse
    {
        $validated = collect($request->validated());

        $token = $this->authService->login($validated);

        return response()->json([
            'message' => 'User logged in successfully',
            'data' => $token
        ]);
    }

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $validated = collect($request->validated());

        $data = $this->authService->register($validated);

        return response()->json([
          'message' => 'User successfully created',
          'data' => new UserResource($data)
        ]);
    }

    public function refreshToken(Request $request): JsonResponse
    {
        $token = $request->bearerToken();

        $data = $this->authService->refreshToken($token);

        return response()->json([
            'message' => 'Token refreshed',
            'data' => $data
        ]);
    }
}
