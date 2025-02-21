<?php

namespace App\Http\Requests\V1\Finance;

use App\Enums\Transaction\TransactionTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class TransactionRequest extends FormRequest
{

    public function rules(): array
    {
        $transactionsTypes = array_column(TransactionTypeEnum::cases(), 'value');

        return [
            'wallet_id' => ['required', 'integer', 'exists:wallets,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'type' => ['required', 'string', Rule::in($transactionsTypes)],
            'wallet_id_transfer' => ['required', 'integer', 'exists:wallets,id'],
        ];
    }
}
