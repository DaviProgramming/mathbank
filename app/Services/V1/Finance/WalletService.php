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

    public function show(Collection $request)
    {
    }

    public function store(Collection $request)
    {
       $user = auth()->user();

       $userWalletLimit = $user->wallets_limit;

       $userWallets = $user->wallet()->count();

       Assert::true($userWallets < $userWalletLimit, 'Limite de wallets atingido.');

       return $this->wallet->create($request->all());
    }

    public function update(Collection $request)
    {

    }

    public function destroy(Collection $request)
    {

    }
}
