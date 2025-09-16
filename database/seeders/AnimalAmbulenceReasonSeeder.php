<?php

namespace Database\Seeders;

use App\Domains\Enums\AnimalAmbulencePriorityEnum;
use App\Models\AnimalAmbulenceReason;
use Illuminate\Database\Seeder;

class AnimalAmbulenceReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reasons = [
            [
                'name' => 'Animal ferido por atropelamento',
                'priority' => AnimalAmbulencePriorityEnum::HIGH->value,
                'color' => '#FF0000',
                'description' => 'Animal ferido por atropelamento',
            ],
            [
                'name' => 'Animal com sinais de envenenamento',
                'priority' => AnimalAmbulencePriorityEnum::HIGH->value,
                'color' => '#FF0000',
                'description' => 'Animal com sinais de envenenamento',
            ],
            [
                'name' => 'Animal com sangramento intenso',
                'priority' => AnimalAmbulencePriorityEnum::HIGH->value,
                'color' => '#FF0000',
                'description' => 'Animal com sangramento intenso',
            ],
            [
                'name' => 'Animal inconsciente ou sem reação',
                'priority' => AnimalAmbulencePriorityEnum::HIGH->value,
                'color' => '#FF0000',
                'description' => 'Animal inconsciente ou sem reação',
            ],
            [
                'name' => 'Outro tipo de emergência grave',
                'priority' => AnimalAmbulencePriorityEnum::HIGH->value,
                'color' => '#FF0000',
                'description' => 'Outro tipo de emergência grave',
            ],
            [
                'name' => 'Animal com ferimento leve',
                'priority' => AnimalAmbulencePriorityEnum::MEDIUM->value,
                'color' => '#FF0000',
                'description' => 'Animal com ferimento leve',
            ],
            [
                'name' => 'Animal preso em local de difícil acesso',
                'priority' => AnimalAmbulencePriorityEnum::MEDIUM->value,
                'color' => '#FF0000',
                'description' => 'Animal preso em local de difícil acesso',
            ],
            [
                'name' => 'Animal com dificuldade para andar, mas consciente',
                'priority' => AnimalAmbulencePriorityEnum::MEDIUM->value,
                'color' => '#FF0000',
                'description' => 'Animal com dificuldade para andar, mas consciente',
            ],
            [
                'name' => 'Animal com apatia ou febre repentina',
                'priority' => AnimalAmbulencePriorityEnum::MEDIUM->value,
                'color' => '#FF0000',
                'description' => 'Animal com apatia ou febre repentina',
            ],
            [
                'name' => 'Animal com suspeita de fratura leve (sem sangramento intenso)',
                'priority' => AnimalAmbulencePriorityEnum::MEDIUM->value,
                'color' => '#FF0000',
                'description' => 'Animal com suspeita de fratura leve (sem sangramento intenso)',
            ],
        ];

        foreach ($reasons as $reason) {
            AnimalAmbulenceReason::create($reason);
        }
    }
}
