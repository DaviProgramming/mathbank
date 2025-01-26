<?php

namespace App\Http\Controllers\V1\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Finance\WalletRequest;
use App\Http\Resources\V1\Finance\WalletResource;
use App\Services\V1\Finance\WalletService;

class WalletsController extends Controller
{
    public function __construct(protected WalletService $walletService)
    {}

    public function show(int $id)
    {
    }

    public function store(WalletRequest $request)
    {
        $validated = collect($request->validated());

        $data = $this->walletService->store($validated);

        return response()->json([
            'message' => 'Carteira criada com sucesso.',
            'data' => new WalletResource($data)
        ]);
    }

    public function update(WalletRequest $request, int $id)
    {
        $validated = collect($request->validated());

        $data = $this->walletService->update($validated, $id);

        return response()->json([
            'message' => 'Carteira atualizada com sucesso.',
            'data' => new WalletResource($data)
        ]);
    }

    public function destroy(int $id)
    {

    }
}
