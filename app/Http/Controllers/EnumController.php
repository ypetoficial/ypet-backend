<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EnumController extends Controller
{
    public function show(Request $request, string $enum)
    {
        $locale = $request->get('locale', config('app.locale', 'en'));
        $enumClass = 'App\\Domains\\Enums\\'.Str::studly($enum).'Enum';

        if (! enum_exists($enumClass)) {
            return $this->error('Enum not found', [], 404);
        }

        $data = ($enumClass)::labels($locale);

        return $this->ok($data);
    }
}
