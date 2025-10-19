<?php

namespace App\Http\Controllers\Product;

use App\Domains\Product\Services\ProductService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends AbstractController
{
    public $requestValidate = StoreProductRequest::class;

    public $requestValidateUpdate = UpdateProductRequest::class;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function supply(Request $request, $id)
    {
        $animalId = (int) $request->get('animal_id');

        if (! $animalId) {
            return $this->error('Parâmetro "animal_id" é obrigatório.');
        }

        try {
            $result = $this->service->calculateSupplyDays((int) $id, $animalId);

            return $this->ok($result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), [], $e->getCode() ?: 500);
        }
    }
}