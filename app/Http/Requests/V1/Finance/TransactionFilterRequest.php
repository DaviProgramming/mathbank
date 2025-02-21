<?php

namespace App\Http\Requests\V1\Finance;

use Illuminate\Foundation\Http\FormRequest;

class TransactionFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'data_inicial' => 'nullable|date_format:Y-m-d',
            'data_final' => 'nullable|date_format:Y-m-d|after_or_equal:data_inicial',
        ];
    }

    public function attributes(): array
    {
        return [
            'data_inicial' => 'Data inicial',
            'data_final' => 'Data final',
        ];
    }
}
