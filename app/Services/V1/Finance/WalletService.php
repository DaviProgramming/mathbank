<?php

namespace App\Services\V1\Finance;

use App\Models\V1\User;
use Illuminate\Support\Collection;

class WalletService
{
    protected User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function show(Collection $request)
    {
        dd($request->all());
    }

    public function store(Collection $request)
    {

    }

    public function update(Collection $request)
    {

    }

    public function destroy(Collection $request)
    {

    }
}
