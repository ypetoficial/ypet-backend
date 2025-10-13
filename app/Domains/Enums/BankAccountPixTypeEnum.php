<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum BankAccountPixTypeEnum: string implements EnumInterface
{
    use EnumTrait;

    case CPF = 'cpf';
    case CNPJ = 'cnpj';
    case EMAIL = 'email';
    case PHONE = 'phone';
    case RANDOM_KEY = 'random_key';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'CPF' => 'CPF',
                'CNPJ' => 'CNPJ',
                'EMAIL' => 'Email',
                'PHONE' => 'Phone',
                'RANDOM_KEY' => 'Random Key',
            ],
            'es' => [
                'CPF' => 'CPF',
                'CNPJ' => 'CNPJ',
                'EMAIL' => 'Correo electrónico',
                'PHONE' => 'Teléfono',
                'RANDOM_KEY' => 'Clave aleatoria',
            ],
            'pt_BR' => [
                'CPF' => 'CPF',
                'CNPJ' => 'CNPJ',
                'EMAIL' => 'E-mail',
                'PHONE' => 'Telefone',
                'RANDOM_KEY' => 'Chave Aleatória',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
