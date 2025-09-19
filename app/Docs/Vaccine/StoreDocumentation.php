<?php

namespace App\Docs\Vaccine;

/**
 * @OA\Post(
 *     path="/api/vaccine",
 *     summary="Cadastra uma nova vacina",
 *     tags={"Vaccines"},
 *
 *     @OA\Parameter(
 *         name="X-Client-Type",
 *         in="header",
 *         required=true,
 *         description="Tipo do cliente",
 *
 *         @OA\Schema(type="string", example="web")
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"name", "type", "dose_count", "dose_interval", "expiration_date", "batch"},
 *
 *             @OA\Property(property="name", type="string", example="Rabies"),
 *             @OA\Property(property="type", type="string", example="Viral"),
 *             @OA\Property(property="purpose", type="string", example="Prevenção da raiva"),
 *             @OA\Property(property="target_specie", type="string", example="Dog"),
 *             @OA\Property(property="dose_count", type="integer", example=2),
 *             @OA\Property(property="dose_interval", type="integer", example=30),
 *             @OA\Property(property="manu_facturer", type="string", example="Pfizer"),
 *             @OA\Property(property="expiration_date", type="string", format="date", example="2025-12-31"),
 *             @OA\Property(property="batch", type="string", example="VX123456")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Vacina cadastrada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=201),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="uuid", type="string", example="cebee980-7772-49f2-b2eb-33b72b09f2b7"),
 *                 @OA\Property(property="name", type="string", example="Rabies"),
 *                 @OA\Property(property="type", type="string", example="Viral"),
 *                 @OA\Property(property="status", type="string", example="active"),
 *                 @OA\Property(property="purpose", type="string", example="Prevenção da raiva"),
 *                 @OA\Property(property="target_specie", type="string", example="Dog"),
 *                 @OA\Property(property="dose_count", type="integer", example=2),
 *                 @OA\Property(property="dose_interval", type="integer", example=30),
 *                 @OA\Property(property="manu_facturer", type="string", example="Pfizer"),
 *                 @OA\Property(property="expiration_date", type="string", format="date", example="2025-12-31"),
 *                 @OA\Property(property="batch", type="string", example="VX123456")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class StoreDocumentation {}
