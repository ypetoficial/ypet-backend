<?php

namespace App\Docs\Vaccine;

/**
 * @OA\Put(
 *     path="/api/vaccine/{uuid}",
 *     summary="Atualiza os dados de uma vacina",
 *     tags={"Vaccines"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="uuid",
 *         in="path",
 *         required=true,
 *         description="UUID da vacina",
 *
 *         @OA\Schema(type="string", example="cebee980-7772-49f2-b2eb-33b72b09f2b7")
 *     ),
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
 *
 *             @OA\Property(property="name", type="string", example="Rabies", nullable=true),
 *             @OA\Property(property="type", type="string", example="Viral", nullable=true),
 *             @OA\Property(property="purpose", type="string", example="Prevenção da raiva", nullable=true),
 *             @OA\Property(property="target_specie", type="string", example="Dog", nullable=true),
 *             @OA\Property(property="dose_count", type="integer", example=2, nullable=true),
 *             @OA\Property(property="dose_interval", type="integer", example=30, nullable=true),
 *             @OA\Property(property="manu_facturer", type="string", example="Pfizer", nullable=true),
 *             @OA\Property(property="expiration_date", type="string", format="date", example="2025-12-31", nullable=true),
 *             @OA\Property(property="batch", type="string", example="VX123456", nullable=true),
 *             @OA\Property(property="alert_at", type="string", format="date-time", example="2025-09-19 10:42:33", nullable=true),
 *             @OA\Property(property="alert_sent", type="integer", example=0, nullable=true)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Vacina atualizada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
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
 *                 @OA\Property(property="batch", type="string", example="VX123456"),
 *                 @OA\Property(property="alert_at", type="string", format="date-time", example="2025-09-19 10:42:33"),
 *                 @OA\Property(property="alert_sent", type="integer", example=0)
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class UpdateDocumentation {}
