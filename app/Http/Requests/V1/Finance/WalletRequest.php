<?php

namespace App\Http\Requests\V1\Finance;

use Illuminate\Validation\Rule;
use App\Enums\Wallet\CurrencysEnum;
use App\Enums\Wallet\WalletStatusEnum;
use App\Enums\Enums\Wallet\WalletTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class WalletRequest extends FormRequest
{
    public function rules(): array
    {
        $walletTypes = array_column(WalletTypeEnum::cases(), 'value');
        $currencyTypes = array_column(CurrencysEnum::cases(), 'value');
        $walletStatuses = array_column(WalletStatusEnum::cases(), 'value');

        return [
            'wallet_type_id' => ['required', 'integer', Rule::in($walletTypes)],
            'currency' => ['required', 'string', Rule::in($currencyTypes)],
            'balance' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'string', Rule::in($walletStatuses)],
        ];
    }

    public function attributes(): array
    {
        return [
            'wallet_type_id' => 'Tipo de carteira',
            'currency' => 'Moeda'
        ];
    }
}
