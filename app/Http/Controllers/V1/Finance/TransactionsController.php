<?php

namespace App\Http\Controllers\V1\Finance;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\V1\Finance\TransactionService;
use App\Http\Requests\V1\Finance\TransactionRequest;
use App\Http\Resources\V1\Finance\TransactionResource;
use App\Http\Requests\V1\Finance\TransactionFilterRequest;
use App\Http\Requests\V1\Finance\TransactionDepositWithdrawRequest;

class TransactionsController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService
    ) {}

    public function allByUser(TransactionFilterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = collect($validated);

        $transactions = $this->transactionService->allByUser($data);

        return response()->json([
            'message' => 'Transações encontradas com sucesso.',
            'data' => TransactionResource::collection($transactions)
        ]);
    }

    public function allByWallet(TransactionFilterRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        $data = collect($validated);

        $transactions = $this->transactionService->allByWallet($data, $id);

        return response()->json([
            'message' => 'Transações encontradas com sucesso.',
            'data' => TransactionResource::collection($transactions)
        ]);
    }

    public function store(TransactionRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = collect($validated);

        $transaction = $this->transactionService->store($data);

        return response()->json([
            'message' => 'Transação criada com sucesso.',
            'data' => new TransactionResource($transaction)
        ]);
    }


    public function deposit(TransactionDepositWithdrawRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = collect($validated);

        $transaction = $this->transactionService->deposit($data);

        return response()->json([
            'message' => 'Depósito realizado com sucesso.',
            'data' => new TransactionResource($transaction)
        ]);
    }

    public function withdraw(TransactionDepositWithdrawRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = collect($validated);

        $transaction = $this->transactionService->withdraw($data);

        return response()->json([
            'message' => 'Saque realizado com sucesso.',
            'data' => new TransactionResource($transaction)
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $transaction = $this->transactionService->show($id);

        return response()->json([
            'message' => 'Transação encontrada com sucesso.',
            'data' => new TransactionResource($transaction)
        ]);
    }

    public function update(TransactionRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        $data = collect($validated);

        $transaction = $this->transactionService->update($data, $id);

        return response()->json([
            'message' => 'Transação atualizada com sucesso.',
            'data' => new TransactionResource($transaction)
    ]);
    }

    public function destroy(int $id): JsonResponse
    {
       $transaction =  $this->transactionService->destroy($id);

        return response()->json([
            'message' => 'Transação deletada com sucesso.',
            'data' => $transaction
        ]);
    }
}
