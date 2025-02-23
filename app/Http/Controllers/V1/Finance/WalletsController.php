<?php

namespace App\Http\Controllers\V1\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Finance\WalletRequest;
use App\Http\Resources\V1\Finance\WalletResource;
use App\Services\V1\Finance\WalletService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\V1\Finance\WalletBalanceHistoryResource;

class WalletsController extends Controller
{
    public function __construct(protected WalletService $walletService)
    {}

    public function allByUser(): JsonResponse
    {
        $data = $this->walletService->allByUser();

        return response()->json(WalletResource::collection($data));
    }

    public function show(int $id): JsonResponse
    {
        $data = $this->walletService->show($id);

        return response()->json(new WalletResource($data));
    }

    public function store(WalletRequest $request): JsonResponse
    {
        $validated = collect($request->validated());

        $data = $this->walletService->store($validated);

        return response()->json([
            'message' => 'Wallet criada com sucesso.',
            'data' => new WalletResource($data)
        ]);
    }

    public function update(WalletRequest $request, int $id): JsonResponse
    {
        $validated = collect($request->validated());

        $data = $this->walletService->update($validated, $id);

        return response()->json([
            'message' => 'Wallet atualizada com sucesso.',
            'data' => new WalletResource($data)
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $data = $this->walletService->destroy($id);

        return response()->json([
            'message' => 'Wallet Excluida com sucesso.',
            'data' => $data
        ]);
    }

    public function balanceHistory(int $id): JsonResponse
    {
        $data = $this->walletService->balanceHistory($id);

        return response()->json(WalletBalanceHistoryResource::collection($data));
    }
}
