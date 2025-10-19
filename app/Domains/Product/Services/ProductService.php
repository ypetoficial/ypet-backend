<?php

namespace App\Domains\Product\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Animal\Entities\AnimalEntity;
use App\Domains\Application\Entities\ApplicationEntity;
use App\Domains\Enums\ProductCategoryEnum;
use App\Domains\Product\Repositories\ProductRepository;
use Illuminate\Validation\ValidationException;

class ProductService extends AbstractService
{
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function beforeSave(array $data): array
    {
        // Ensure default status and UUID
        $data['status'] = (bool) ($data['status'] ?? true);
        $data['uuid'] = $data['uuid'] ?? (string) str()->uuid();

        return $data;
    }

    public function validateOnInsert(array $params): bool
    {
        $category = $params['category'] ?? null;

        if (in_array($category, [ProductCategoryEnum::MEDICATION->value, ProductCategoryEnum::FOOD->value])) {
            foreach (['standard_quantity', 'reference_weight', 'standard_days'] as $field) {
                if (empty($params[$field])) {
                    throw ValidationException::withMessages([$field => 'Campo obrigatório para categoria selecionada.']);
                }
            }
        }

        if (! empty($params['standard_days']) && (int) $params['standard_days'] < 1) {
            throw ValidationException::withMessages(['standard_days' => 'O valor deve ser maior ou igual a 1.']);
        }

        return true;
    }

    public function validateOnUpdate($id, array $params): bool
    {
        if (! empty($params['standard_days']) && (int) $params['standard_days'] < 1) {
            throw ValidationException::withMessages(['standard_days' => 'O valor deve ser maior ou igual a 1.']);
        }

        return true;
    }

    public function delete($id)
    {
        // Block deletion when there are application records
        $hasApplications = ApplicationEntity::query()->where('product_id', $id)->exists();
        if ($hasApplications) {
            throw new \Exception('Exclusão bloqueada: há registros de aplicação vinculados ao produto.');
        }

        // Inactivate instead of hard delete
        $entity = $this->find($id);

        return $this->repository->update($entity, ['status' => false]);
    }

    /**
     * Calcula os dias estimados de suprimento para um animal específico
     */
    public function calculateSupplyDays(int $productId, int $animalId): array
    {
        $product = $this->find($productId);
        $animal = AnimalEntity::find($animalId);

        if (! $animal) {
            throw new \Exception('Animal não encontrado', 404);
        }

        $weight = (float) ($animal->weight ?? 0);
        $stock = (float) ($product->stock ?? 0);
        $standardQuantity = (float) ($product->standard_quantity ?? 0);
        $referenceWeight = (float) ($product->reference_weight ?? 0);
        $standardDays = (int) ($product->standard_days ?? 0);

        if ($weight <= 0 || $standardQuantity <= 0 || $referenceWeight <= 0 || $standardDays <= 0) {
            return [
                'days' => 0.0,
                'details' => [
                    'reason' => 'Parâmetros insuficientes para cálculo',
                ],
            ];
        }

        $consumoPorKgDia = $standardQuantity / ($referenceWeight * $standardDays);
        $consumoDiarioAnimal = $consumoPorKgDia * $weight;

        if ($consumoDiarioAnimal <= 0) {
            return [
                'days' => 0.0,
                'details' => [
                    'reason' => 'Consumo diário inválido',
                ],
            ];
        }

        $estimatedDays = $stock / $consumoDiarioAnimal;

        return [
            'days' => round($estimatedDays, 2),
            'details' => [
                'stock' => $stock,
                'animal_weight' => $weight,
                'consumo_diario_por_kg' => round($consumoPorKgDia, 6),
                'consumo_diario_animal' => round($consumoDiarioAnimal, 6),
            ],
        ];
    }
}
