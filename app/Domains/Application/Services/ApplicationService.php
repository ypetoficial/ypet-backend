<?php

namespace App\Domains\Application\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Animal\Entities\AnimalEntity;
use App\Domains\Animal\Services\AnimalHistoryService;
use App\Domains\Application\Repositories\ApplicationRepository;
use App\Domains\Product\Services\ProductService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ApplicationService extends AbstractService
{
    public function __construct(ApplicationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validateOnInsert(array $data): bool
    {
        $animalId = (int) Arr::get($data, 'animal_id');
        $productId = (int) Arr::get($data, 'product_id');
        $category = (string) Arr::get($data, 'category');
        $applicationDate = (string) Arr::get($data, 'application_date');
        $doseApplied = (float) Arr::get($data, 'dose_applied');

        $animal = AnimalEntity::find($animalId);
        if (! $animal) {
            throw ValidationException::withMessages(['animal_id' => 'Animal não encontrado.']);
        }

        return true;
    }

    public function beforeSave(array $data): array
    {
        $animalId = (int) Arr::get($data, 'animal_id');
        $productId = (int) Arr::get($data, 'product_id');

        $animal = AnimalEntity::find($animalId);

        // Preencher peso do animal caso não informado
        $data['animal_weight'] = $data['animal_weight'] ?? ($animal?->weight ?? null);

        // Calcular dias estimados de suprimento
        try {
            /** @var ProductService $productService */
            $productService = app(ProductService::class);
            $calc = $productService->calculateSupplyDays($productId, $animalId);
            $data['estimated_days_supply'] = $calc['days'] ?? null;
        } catch (\Throwable $e) {
            Log::warning('Falha ao calcular dias estimados de suprimento: '.$e->getMessage());
        }

        // Responsável pela aplicação
        $data['responsible_user_id'] = $data['responsible_user_id'] ?? Auth::user()?->id;

        // Garantir uuid
        $data['uuid'] = $data['uuid'] ?? (string) str()->uuid();

        return $data;
    }

    public function afterSave($entity, array $params)
    {
        try {
            /** @var AnimalHistoryService $historyService */
            $historyService = app(AnimalHistoryService::class);
            $historyService->save([
                'animal_id' => (int) $entity->getAttribute('animal_id'),
                'type' => 'application',
                'category' => (string) $entity->getAttribute('category'),
                'date' => $entity->getAttribute('application_date'),
                'notes' => $entity->getAttribute('observations'),
                'created_by' => Auth::user()?->id,
                'meta' => [
                    'application_id' => (int) $entity->getAttribute('id'),
                    'product_id' => (int) $entity->getAttribute('product_id'),
                    'animal_weight' => (float) $entity->getAttribute('animal_weight'),
                    'estimated_days_supply' => (float) $entity->getAttribute('estimated_days_supply'),
                    'period_days' => $entity->getAttribute('period_days'),
                    'frequency' => $entity->getAttribute('frequency'),
                    'via_administration' => $entity->getAttribute('via_administration'),
                    'supplement_type' => $entity->getAttribute('supplement_type'),
                    'meals_per_day' => $entity->getAttribute('meals_per_day'),
                    'daily_quantity_g_per_kg' => $entity->getAttribute('daily_quantity_g_per_kg'),
                    'next_dose_date' => $entity->getAttribute('next_dose_date'),
                    'lot_number' => $entity->getAttribute('lot_number'),
                    'expiration_date' => $entity->getAttribute('expiration_date'),
                ],
            ]);
        } catch (\Throwable $e) {
            Log::error('Erro ao processar pós-salvar aplicação: '.$e->getMessage());
        }

        return $entity;
    }
}
