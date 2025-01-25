<?php

namespace App\Http\Controllers\V1\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Finance\WalletRequest;
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
        $validated = $request->validated();

        $data = $this->walletService->store($validated);

        return response()->json($data);
    }

    public function update(WalletRequest $request)
    {
        $validated = $request->validated();

        $data = $this->walletService->update($validated);

        return response()->json($data);
    }

    public function destroy(int $id)
    {

    }
}
