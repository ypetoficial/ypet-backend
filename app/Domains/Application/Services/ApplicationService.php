<?php

namespace App\Domains\Application\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Animal\Entities\AnimalEntity;
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
        // salvar historico do animal
        return $entity;
    }
}
