<?php

namespace App\Http\Requests\V1\Finance;

use App\Enums\Enums\Wallet\WalletTypeEnum;
use Illuminate\Validation\Rule;
use App\Enums\Wallet\CurrencysEnum;
use App\Models\V1\WalletType;
use Illuminate\Foundation\Http\FormRequest;

class WalletRequest extends FormRequest
{
    public function rules(): array
    {
        $walletTypes = array_column(WalletTypeEnum::cases(), 'value');
        $currencyTypes = array_column(CurrencysEnum::cases(), 'value');

        return [
            'wallet_type_id' => ['required', 'integer', Rule::in($walletTypes)],
            'currency' => ['required', 'string', Rule::in($currencyTypes)]
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
