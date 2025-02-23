<?php

namespace App\Observers\V1;

use App\Models\V1\Transaction;
use App\Models\V1\WalletBalanceHistory;

class TransactionObserver
{
    protected WalletBalanceHistory $walletBalanceHistory;

    public function __construct()
    {
        $this->walletBalanceHistory = new WalletBalanceHistory();
    }

    public function created(Transaction $transaction)
    {
        $this->walletBalanceHistory->create([
            'wallet_id' => $transaction->wallet_id,
            'balance' => $transaction->wallet->balance,
            'recorded_at' => now()
        ]);

        $transaction->isSameWallet() ?: $this->walletBalanceHistory->create([
            'wallet_id' => $transaction->walletTransfer->id,
            'balance' => $transaction->walletTransfer->balance,
            'recorded_at' => now()
        ]);
    }

    public function updated(Transaction $transaction)
    {
        $this->walletBalanceHistory->create([
            'wallet_id' => $transaction->wallet_id,
            'balance' => $transaction->wallet->balance,
            'recorded_at' => now()
        ]);

        $transaction->isSameWallet() ?: $this->walletBalanceHistory->create([
            'wallet_id' => $transaction->walletTransfer->id,
            'balance' => $transaction->walletTransfer->balance,
            'recorded_at' => now()
        ]);
    }

    public function deleted(Transaction $transaction)
    {
        $this->walletBalanceHistory->create([
            'wallet_id' => $transaction->wallet_id,
            'balance' => $transaction->wallet->balance,
            'recorded_at' => now()
        ]);

        $transaction->isSameWallet() ?: $this->walletBalanceHistory->create([
            'wallet_id' => $transaction->walletTransfer->id,
            'balance' => $transaction->walletTransfer->balance,
            'recorded_at' => now()
        ]);
    }
}
