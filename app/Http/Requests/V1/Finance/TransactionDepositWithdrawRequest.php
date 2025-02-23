<?php

namespace App\Http\Requests\V1\Finance;

use Illuminate\Foundation\Http\FormRequest;

class TransactionDepositWithdrawRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'wallet_id' => ['required', 'integer', 'exists:wallets,id'],
            'amount' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'wallet_id' => 'Carteira',
            'amount' => 'Valor',
        ];
    }
}
