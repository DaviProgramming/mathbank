<?php

namespace App\Http\Requests\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'max:240', 'min:6']
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Senha',
        ];
    }
}
