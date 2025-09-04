<?php

namespace App\Docs\LostAnimals;

/**
 * @OA\Put(
 *     path="/api/lost-animals/{id}",
 *     summary="Atualiza os dados de um animal perdido",
 *     tags={"Lost Animals"},
 *
 *     @OA\Parameter(name="id", in="path", required=true, description="ID do registro", @OA\Schema(type="integer", example=1)),
 *     @OA\Parameter(name="Authorization", in="header", required=true, description="Token JWT", @OA\Schema(type="string", example="Bearer eyJ...")),
 *     @OA\Parameter(name="X-Client-Type", in="header", required=true, description="Tipo do cliente", @OA\Schema(type="string", example="web")),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"lost_at", "status", "address"},
 *
 *             @OA\Property(property="lost_at", type="string", format="date-time", example="2025-07-25T12:00:00Z"),
 *             @OA\Property(property="status", type="string", example="pending"),
 *             @OA\Property(property="address", type="object",
 *                 required={"street", "number", "district", "city", "state", "zip_code", "country"},
 *                 @OA\Property(property="street", type="string", example="Av. Paulista"),
 *                 @OA\Property(property="number", type="string", example="1000"),
 *                 @OA\Property(property="complement", type="string", example="Bloco B"),
 *                 @OA\Property(property="district", type="string", example="Bela Vista"),
 *                 @OA\Property(property="city", type="string", example="São Paulo"),
 *                 @OA\Property(property="state", type="string", example="SP"),
 *                 @OA\Property(property="zip_code", type="string", example="01310-100"),
 *                 @OA\Property(property="country", type="string", example="Brasil"),
 *                 @OA\Property(property="latitude", type="number", example=-23.561414),
 *                 @OA\Property(property="longitude", type="number", example=-46.655881)
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Animal perdido atualizado com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="status", type="string", example="pending")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     ),
 *
 *     @OA\Response(response=422, description="Erro de validação")
 * )
 */
class LostAnimalUpdateDocumentation {}
