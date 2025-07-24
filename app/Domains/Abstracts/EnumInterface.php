<?php

namespace App\Domains\Abstracts;

interface EnumInterface {
    public static function getByName(string $name): mixed;
    public static function labelByValue(string|int $value, $locale = 'en'): array;
}
