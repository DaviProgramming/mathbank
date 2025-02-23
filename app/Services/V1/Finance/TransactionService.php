<?php

namespace App\Services\V1\Finance;

use App\Models\V1\Wallet;
use Webmozart\Assert\Assert;
use App\Models\V1\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class TransactionService
{
    protected Transaction $transaction;
    protected Wallet $wallet;

    public function __construct() {
        $this->transaction = new Transaction();
        $this->wallet = new Wallet();
    }

    public function allByUser(Collection $request): Collection
    {
        $transactions = auth()->user()
            ->wallet()
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->flatten();

        if (!$request->has('data_inicial')) {
            return $transactions;
        }

        $dataInicial = Carbon::parse($request->get('data_inicial'));

        $dataFinal = Carbon::parse($request->get('data_final')) ?? $dataInicial;

        return $transactions->filter(function ($transaction) use ($dataInicial, $dataFinal) {
            return $transaction->created_at->between($dataInicial, $dataFinal);
        });
    }

    public function store(Collection $request): Transaction
    {
        $walletOrigin = $request->get('wallet_id');

        $walletOrigin = $this->wallet->find($walletOrigin);

        Assert::notNull($walletOrigin, 'Wallet de origem não encontrada.');

        $walletDestination = $request->get('wallet_id_transfer');

        $walletDestination = $this->wallet->find($walletDestination);

        Assert::notNull($walletDestination, 'Wallet de destino não encontrada.');

        Assert::notSame($walletOrigin->id, $walletDestination->id, 'Wallet de origem e destino não podem ser iguais.');

        $transferAmount = $request->get('amount');

        Assert::true($walletOrigin->balance >= $transferAmount, 'Saldo insuficiente.');

        $walletOrigin->balance -= $transferAmount;
        $walletDestination->balance += $transferAmount;

        $walletOrigin->save();
        $walletDestination->save();

        return $this->transaction->create($request->all());
    }

    public function deposit(Collection $request): Transaction
    {
        $wallet = $request->get('wallet_id');

        $wallet = $this->wallet->find($wallet);

        Assert::notNull($wallet, 'Wallet não encontrada.');

        $wallet->balance += $request->get('amount');

        $wallet->save();

        return $this->transaction->create($request->all());
    }

    public function withdraw(Collection $request): Transaction
    {
        $wallet = $request->get('wallet_id');

        $wallet = $this->wallet->find($wallet);

        $amount = $request->get('amount');

        Assert::notNull($wallet, 'Wallet não encontrada.');

        Assert::true($wallet->balance >= $amount, 'Saldo insuficiente.');

        $wallet->balance -= $amount;

        $wallet->save();

        return $this->transaction->create($request->all());
    }

    public function show(int $id): Transaction
    {
        $transaction = $this->transaction->find($id);

        Assert::notNull($transaction, 'Transação não encontrada.');

        return $transaction;
    }

    public function update(Collection $request, int $id): Transaction
    {
        $transaction = $this->transaction->find($id);

        Assert::notNull($transaction, 'Transação não encontrada.');

        $walletOrigin = $request->get('wallet_id');

        $walletOrigin = $this->wallet->find($walletOrigin);

        Assert::notNull($walletOrigin, 'Wallet de origem não encontrada.');

        $walletDestination = $request->get('wallet_id_transfer');

        $walletDestination = $this->wallet->find($walletDestination);

        Assert::notNull($walletDestination, 'Wallet de destino não encontrada.');

        Assert::notSame($walletOrigin->id, $walletDestination->id, 'Wallet de origem e destino não podem ser iguais.');

        $transferAmount = $request->get('amount');

        Assert::true($walletOrigin->balance >= $transferAmount, 'Saldo insuficiente.');

        $walletOrigin->balance -= $transferAmount;
        $walletDestination->balance += $transferAmount;

        $walletOrigin->save();
        $walletDestination->save();

        $transaction->update($request->all());

        return $transaction->refresh();
    }

    public function destroy(int $id): bool
    {
        $transaction = $this->transaction->find($id);

        Assert::notNull($transaction, 'Transação não encontrada.');

        $walletOrigin = $transaction->wallet_id;

        $walletOrigin = $this->wallet->find($walletOrigin);

        $walletDestination = $transaction->wallet_id_transfer;

        $walletDestination = $this->wallet->find($walletDestination);

        $walletOrigin->balance += $transaction->amount;
        $walletDestination->balance -= $transaction->amount;

        $walletOrigin->save();
        $walletDestination->save();

        return $transaction->delete();
    }
}
