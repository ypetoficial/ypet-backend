<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EnumController extends Controller
{
    public function show(Request $request, string $enum)
    {
        $locale = $request->get('locale', 'pt_BR');

        $specialEnums = [
            'uf' => 'UF',
        ];

        $enumClass = $specialEnums[strtolower($enum)] ?? Str::studly($enum);

        $enumClass = 'App\\Domains\\Enums\\'.$enumClass.'Enum';

        if (! enum_exists($enumClass)) {
            return $this->error('Enum not found', [], 404);
        }

        $data = ($enumClass)::labels($locale);

        return $this->ok($data);
    }
}
