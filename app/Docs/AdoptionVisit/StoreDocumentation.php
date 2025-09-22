<?php

namespace App\Docs\AdoptionVisit;

/**
 * @OA\Post(
 *     path="/api/adoption-visits",
 *     summary="Cadastra uma nova visita de adoção",
 *     tags={"Adoption Visit"},
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
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"citizen_id", "animal_id", "start_date", "date_end", "status", "actions"},
 *
 *             @OA\Property(property="citizen_id", type="integer", example=1),
 *             @OA\Property(property="animal_id", type="integer", example=1),
 *             @OA\Property(property="start_date", type="string", format="date", example="2025-09-01"),
 *             @OA\Property(property="date_end", type="string", format="date", example="2025-09-10"),
 *             @OA\Property(property="status", type="integer", example=1),
 *             @OA\Property(property="actions", type="integer", example=2)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Visita de adoção cadastrada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="message", type="string", example="Operação realizada com sucesso"),
 *             @OA\Property(property="show", type="boolean", example=true),
 *             @OA\Property(
 *                 property="response",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="citizen_id", type="integer", example=1),
 *                 @OA\Property(property="animal_id", type="integer", example=1),
 *                 @OA\Property(property="start_date", type="string", format="date", example="2025-09-01"),
 *                 @OA\Property(property="date_end", type="string", format="date", example="2025-09-10"),
 *                 @OA\Property(property="status", type="integer", example=1),
 *                 @OA\Property(property="actions", type="integer", example=2),
 *                 @OA\Property(property="uuid", type="string", example="b442e30a-f2a1-4551-9ac0-ef497a58ded4"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-06T18:51:42.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-06T18:51:42.000000Z")
 *             )
 *         )
 *     )
 * )
 */
class StoreDocumentation {}
