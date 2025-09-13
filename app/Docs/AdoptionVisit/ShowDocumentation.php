<?php

namespace App\Docs\AdoptionVisit;

/**
 * @OA\Get(
 *     path="/api/adoption-visits/{uuid}",
 *     summary="Exibe os detalhes de uma visita de adoção",
 *     tags={"Adoption Visit"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="uuid",
 *         in="path",
 *         required=true,
 *         description="UUID da visita de adoção",
 *
 *         @OA\Schema(type="string", example="b442e30a-f2a1-4551-9ac0-ef497a58ded4")
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
 *     @OA\Response(
 *         response=200,
 *         description="Visita de adoção encontrada",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="uuid", type="string", example="b442e30a-f2a1-4551-9ac0-ef497a58ded4"),
 *                 @OA\Property(property="citizen_id", type="integer", example=1),
 *                 @OA\Property(property="animal_id", type="integer", example=1),
 *                 @OA\Property(property="start_date", type="string", format="date", example="2025-09-08"),
 *                 @OA\Property(property="date_end", type="string", format="date", example="2025-09-10"),
 *                 @OA\Property(property="status", type="string", example="pending"),
 *                 @OA\Property(property="actions", type="string", example="2"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-06T18:51:42.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-10T02:05:38.000000Z")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=false)
 *         )
 *     )
 * )
 */
class ShowDocumentation {}
