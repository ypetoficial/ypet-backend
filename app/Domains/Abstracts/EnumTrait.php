<?php

namespace App\Domains\Abstracts;

trait EnumTrait
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getByName(string $name): mixed
    {
        $array = array_filter(self::cases(), fn ($case) => $case->name == $name);

        return array_values($array)[0] ?? [];
    }

    public static function labels($locale = 'en'): array
    {
        return array_map(function ($case) use ($locale) {
            return [
                'value' => $case->value,
                'name' => $case->name,
                'label' => self::getTranslatedLabel($case->name, $locale),
                'color' => self::getColor($case->name),
                'description' => self::getDescription($case->name, $locale),
            ];
        }, self::cases());
    }

    public static function labelByValue(string|int $value, $locale = 'en'): array
    {
        $array = array_filter(self::labels($locale), fn ($case) => $case['value'] == $value);

        return array_values($array)[0] ?? [];
    }

    public static function labelByName(string $name, $locale = 'en'): array
    {
        $array = array_filter(self::labels($locale), fn ($case) => $case['name'] === $name);

        return array_values($array)[0] ?? [];
    }

    private static function getTranslatedLabel(string $name, $locale = 'en'): string
    {
        return data_get(self::translations($locale), $name, $name);
    }

    private static function getColor(string $name): string
    {
        return data_get(self::colors(), $name, '#000000');
    }

    public static function colors(): array
    {
        return [];
    }

    public static function descriptions(string $locale): array
    {
        return [];
    }

    private static function getDescription(string $name, $locale = 'en'): string
    {
        return data_get(self::descriptions($locale), $name, '');
    }
}
