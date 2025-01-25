<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\UserLoginRequest;
use App\Http\Requests\V1\Auth\UserRegisterRequest;
use App\Http\Resources\V1\Auth\UserResource;
use App\Services\V1\Auth\AuthService;
use Illuminate\Http\JsonResponse;

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
}
