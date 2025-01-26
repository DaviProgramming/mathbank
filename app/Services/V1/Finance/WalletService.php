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

       return $this->wallet->create($request->all());
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

    public function destroy(Collection $request)
    {

    }
}
