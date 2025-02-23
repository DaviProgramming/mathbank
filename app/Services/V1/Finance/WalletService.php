<?php

namespace App\Services\V1\Finance;

use App\Models\V1\Wallet;
use Illuminate\Support\Collection;
use Webmozart\Assert\Assert;

class WalletService
{
    protected Wallet $wallet;

    public function __construct()
    {
        $this->wallet = new Wallet();
    }

    public function allByUser()
    {
        $user = auth()->user();

        return $user->wallet()->get();
    }

    public function show(int $id): Wallet
    {
        $user = auth()->user();

        $userWallet = $user->wallet()->find($id);

        Assert::notNull($userWallet, 'Wallet não encontrada.');

        return $userWallet;
    }

    public function store(Collection $request): Wallet
    {
       $user = auth()->user();

       $userWalletLimit = $user->wallets_limit;

       $userWallets = $user->wallet()->count();

       Assert::true($userWallets < $userWalletLimit, 'Limite de wallets atingido.');

       $newWalletData = $request->all() + ['user_id' => $user->id];

       return $this->wallet->create($newWalletData);
    }

    public function update(Collection $request, int $id): Wallet
    {
        $user = auth()->user();

        $userWallet = $user->wallet()->find($id);

        Assert::notNull($userWallet, 'Wallet não encontrada.');

        $data = $request->all();

        $userWallet->update($data);

        return $userWallet;
    }

    public function destroy(int $id): bool
    {
        $user = auth()->user();

        $userWallet = $user->wallet()->find($id);

        Assert::notNull($userWallet, 'Wallet não encontrada.');

        Assert::true($userWallet->balance === 0, 'Wallet não pode ser deletada, pois possui saldo.');

        Assert::true($userWallet->transactions->isEmpty(), 'Wallet não pode ser deletada, pois possui transações.');

        return $userWallet->delete();
    }

    public function balanceHistory(int $id): Collection
    {
        $wallet = $this->wallet->find($id);

        Assert::notNull($wallet, 'Wallet não encontrada.');

        return $wallet->balanceHistory;
    }
}
