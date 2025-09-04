<?php

namespace App\Docs\LostAnimals;

/**
 * @OA\Post(
 *     path="/api/lost-animals",
 *     summary="Cadastra um novo animal perdido",
 *     tags={"Lost Animals"},
 *
 *     @OA\Parameter(
 *         name="Authorization",
 *         in="header",
 *         required=true,
 *         description="Token JWT. Exemplo: Bearer {token}",
 *
 *         @OA\Schema(type="string", example="Bearer eyJ...")
 *     ),
 *
 *     @OA\Parameter(
 *         name="X-Client-Type",
 *         in="header",
 *         required=true,
 *         description="Tipo do cliente (web, mobile)",
 *
 *         @OA\Schema(type="string", example="web")
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"animal_id", "lost_at", "status", "address"},
 *
 *             @OA\Property(property="animal_id", type="integer", example=1),
 *             @OA\Property(property="lost_at", type="string", format="date-time", example="2025-07-24T10:00:00Z"),
 *             @OA\Property(property="status", type="string", example="pending"),
 *             @OA\Property(property="address", type="object",
 *                 required={"street", "number", "district", "city", "state", "zip_code", "country"},
 *                 @OA\Property(property="street", type="string", example="Rua das Flores"),
 *                 @OA\Property(property="number", type="string", example="123"),
 *                 @OA\Property(property="complement", type="string", example="Apto 202"),
 *                 @OA\Property(property="district", type="string", example="Centro"),
 *                 @OA\Property(property="city", type="string", example="São Paulo"),
 *                 @OA\Property(property="state", type="string", example="SP"),
 *                 @OA\Property(property="zip_code", type="string", example="01000-000"),
 *                 @OA\Property(property="country", type="string", example="Brasil"),
 *                 @OA\Property(property="latitude", type="number", example=-23.55052),
 *                 @OA\Property(property="longitude", type="number", example=-46.633308)
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Animal perdido cadastrado com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=201),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="animal_id", type="integer", example=1),
 *                 @OA\Property(property="status", type="string", example="pending")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação"
 *     )
 * )
 */
class LostAnimalStoreDocumentation {}
