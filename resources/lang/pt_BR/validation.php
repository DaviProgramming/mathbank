<?php

return [
    'accepted'             => 'O :attribute deve ser aceito.',
    'active_url'           => 'O :attribute não é uma URL válida.',
    'after'                => 'O :attribute deve ser uma data posterior a :date.',
    'alpha'                => 'O :attribute deve conter apenas letras.',
    'alpha_dash'           => 'O :attribute deve conter apenas letras, números, hífens e underscores.',
    'alpha_num'            => 'O :attribute deve conter apenas letras e números.',
    'array'                => 'O :attribute deve ser um array.',
    'before'               => 'O :attribute deve ser uma data anterior a :date.',
    'between'              => [
        'numeric' => 'O :attribute deve estar entre :min e :max.',
        'file'    => 'O :attribute deve estar entre :min e :max kilobytes.',
        'string'  => 'O :attribute deve ter entre :min e :max caracteres.',
        'array'   => 'O :attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'A confirmação do :attribute não coincide.',
    'date'                 => 'O :attribute não é uma data válida.',
    'date_format'          => 'O :attribute não corresponde ao formato :format.',
    'different'            => 'Os campos :attribute e :other devem ser diferentes.',
    'digits'               => 'O :attribute deve ter :digits dígitos.',
    'digits_between'       => 'O :attribute deve ter entre :min e :max dígitos.',
    'dimensions'           => 'O :attribute tem dimensões de imagem inválidas.',
    'distinct'             => 'O campo :attribute tem um valor duplicado.',
    'email'                => 'O :attribute deve ser um endereço de e-mail válido.',
    'exists'               => 'O :attribute selecionado é inválido.',
    'file'                 => 'O :attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute é obrigatório.',
    'gt'                   => [
        'numeric' => 'O :attribute deve ser maior que :value.',
        'file'    => 'O :attribute deve ser maior que :value kilobytes.',
        'string'  => 'O :attribute deve ter mais de :value caracteres.',
        'array'   => 'O :attribute deve ter mais de :value itens.',
    ],
    'gte'                  => [
        'numeric' => 'O :attribute deve ser maior ou igual a :value.',
        'file'    => 'O :attribute deve ser maior ou igual a :value kilobytes.',
        'string'  => 'O :attribute deve ter :value ou mais caracteres.',
        'array'   => 'O :attribute deve ter :value ou mais itens.',
    ],
    'image'                => 'O :attribute deve ser uma imagem.',
    'in'                   => 'O :attribute selecionado é inválido.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => 'O :attribute deve ser um número inteiro.',
    'ip'                   => 'O :attribute deve ser um endereço IP válido.',
    'ipv4'                 => 'O :attribute deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'O :attribute deve ser um endereço IPv6 válido.',
    'json'                 => 'O :attribute deve ser uma string JSON válida.',
    'lt'                   => [
        'numeric' => 'O :attribute deve ser menor que :value.',
        'file'    => 'O :attribute deve ser menor que :value kilobytes.',
        'string'  => 'O :attribute deve ter menos de :value caracteres.',
        'array'   => 'O :attribute deve ter menos de :value itens.',
    ],
    'lte'                  => [
        'numeric' => 'O :attribute deve ser menor ou igual a :value.',
        'file'    => 'O :attribute deve ser menor ou igual a :value kilobytes.',
        'string'  => 'O :attribute deve ter :value ou menos caracteres.',
        'array'   => 'O :attribute deve ter :value ou menos itens.',
    ],
    'max'                  => [
        'numeric' => 'O :attribute não pode ser maior que :max.',
        'file'    => 'O :attribute não pode ser maior que :max kilobytes.',
        'string'  => 'O :attribute não pode ter mais de :max caracteres.',
        'array'   => 'O :attribute não pode ter mais de :max itens.',
    ],
    'mimes'                => 'O :attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O :attribute deve ser no mínimo :min.',
        'file'    => 'O :attribute deve ter no mínimo :min kilobytes.',
        'string'  => 'O :attribute deve ter no mínimo :min caracteres.',
        'array'   => 'O :attribute deve ter no mínimo :min itens.',
    ],
    'not_in'               => 'O :attribute selecionado é inválido.',
    'numeric'              => 'O :attribute deve ser um número.',
    'password'             => 'A senha está incorreta.',
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O formato de :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other for :value.',
    'required_unless'      => 'O campo :attribute é obrigatório, a menos que :other seja :value.',
    'same'                 => 'Os campos :attribute e :other devem ser iguais.',
    'size'                 => [
        'numeric' => 'O :attribute deve ser :size.',
        'file'    => 'O :attribute deve ter :size kilobytes.',
        'string'  => 'O :attribute deve ter :size caracteres.',
        'array'   => 'O :attribute deve ter :size itens.',
    ],
    'starts_with'          => 'O :attribute deve começar com um dos seguintes: :values.',
    'string'               => 'O :attribute deve ser uma string.',
    'timezone'             => 'O :attribute deve ser uma zona válida.',
    'unique'               => 'O :attribute já foi tomado.',
    'uploaded'             => 'O :attribute falhou ao ser carregado.',
    'url'                  => 'O :attribute não é uma URL válida.',
    'uuid'                 => 'O :attribute deve ser um UUID válido.',
];
