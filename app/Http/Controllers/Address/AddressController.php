<?php

namespace App\Http\Controllers\Address;

use App\Http\Requests\SearchCepRequest;
use App\Http\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;
use App\Domains\Address\Services\AddressService;
use Illuminate\Support\Facades\Http;


class AddressController extends AbstractController
{
    public function __construct(AddressService $service)
    {
        $this->service = $service;
    }

    public function searchCep(SearchCepRequest $request): JsonResponse
    {
        $url = config('services.busca_cep.url').$request->cep;

        try {
            $response = Http::timeout(5)->get($url);

            if ($response->failed()) {
                return response()->json(['error' => 'CEP não encontrado'], 404);
            }

            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar o CEP'], 500);
        }
    }
}
