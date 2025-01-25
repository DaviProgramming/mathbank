<?php

namespace App\Services\V1\Finance;

use App\Models\V1\Wallet;
use Illuminate\Support\Collection;

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
       return $this->wallet->create($request->all());
    }

    public function update(Collection $request)
    {

    }

    public function destroy(Collection $request)
    {

    }
}
