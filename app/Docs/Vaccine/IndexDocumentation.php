<?php

namespace App\Docs\Vaccine;

/**
 * @OA\Get(
 *     path="/api/vaccine",
 *     summary="Lista todas as vacinas",
 *     tags={"Vaccines"},
 *     security={{"bearerAuth": {}}},
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
 *     @OA\Response(
 *         response=200,
 *         description="Lista de vacinas retornada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *
 *                 @OA\Items(
 *
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="uuid", type="string", example="a3f4c9b2-1234-5678-9abc-9876543210ff"),
 *                     @OA\Property(property="name", type="string", example="Rabies 2"),
 *                     @OA\Property(property="type", type="string", example="Viral"),
 *                     @OA\Property(property="purpose", type="string", example="Prevenção da raiva"),
 *                     @OA\Property(property="target_specie", type="string", example="Dog"),
 *                     @OA\Property(property="dose_count", type="integer", example=3),
 *                     @OA\Property(property="dose_interval", type="integer", example=21),
 *                     @OA\Property(property="manu_facturer", type="string", example="XYZ Pharma"),
 *                     @OA\Property(property="expiration_date", type="string", format="date", example="2026-12-31"),
 *                     @OA\Property(property="batch", type="string", example="RB-2025-002"),
 *                     @OA\Property(property="status", type="string", example="active")
 *                 )
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class IndexDocumentation {}
