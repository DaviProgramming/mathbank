<?php

namespace App\Http\Controllers\V1\Finance;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\V1\Finance\TransactionService;
use App\Http\Requests\V1\Finance\TransactionRequest;
use App\Http\Resources\V1\Finance\TransactionResource;

class TransactionsController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService
    ) {}

    public function allByUser(): JsonResponse
    {
        $transactions = $this->transactionService->allByUser();

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
