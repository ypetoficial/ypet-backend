<?php

namespace App\Docs\AdoptionVisit;

/**
 * @OA\Get(
 *     path="/api/adoption-visits",
 *     summary="Lista todas as visitas de adoção",
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
 *     @OA\Parameter(
 *         name="citizen_name",
 *         in="query",
 *         required=false,
 *         description="Filtrar pelo nome do cidadão",
 *
 *         @OA\Schema(type="string", example="Paulo")
 *     ),
 *
 *     @OA\Parameter(
 *         name="animal_name",
 *         in="query",
 *         required=false,
 *         description="Filtrar pelo nome do animal",
 *
 *         @OA\Schema(type="string", example="Rex")
 *     ),
 *
 *     @OA\Parameter(
 *         name="start_date",
 *         in="query",
 *         required=false,
 *         description="Filtrar pela data inicial da visita (>=)",
 *
 *         @OA\Schema(type="string", format="date", example="2025-09-02")
 *     ),
 *
 *     @OA\Parameter(
 *         name="date_end",
 *         in="query",
 *         required=false,
 *         description="Filtrar pela data final da visita (<=)",
 *
 *         @OA\Schema(type="string", format="date", example="2025-09-10")
 *     ),
 *
 *     @OA\Parameter(
 *         name="status",
 *         in="query",
 *         required=false,
 *         description="Filtrar pelo status da visita",
 *
 *         @OA\Schema(type="string", example="pending")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Lista de visitas de adoção retornada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="current_page", type="integer", example=1),
 *                 @OA\Property(
 *                     property="data",
 *                     type="array",
 *
 *                     @OA\Items(
 *
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="uuid", type="string", example="b442e30a-f2a1-4551-9ac0-ef497a58ded4"),
 *                         @OA\Property(property="citizen_id", type="integer", example=1),
 *                         @OA\Property(property="animal_id", type="integer", example=1),
 *                         @OA\Property(property="start_date", type="string", format="date", example="2025-09-02"),
 *                         @OA\Property(property="date_end", type="string", format="date", example="2025-09-10"),
 *                         @OA\Property(property="status", type="string", example="pending"),
 *                         @OA\Property(property="actions", type="string", example="2"),
 *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-06T18:51:42.000000Z"),
 *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-06T18:51:42.000000Z")
 *                     )
 *                 )
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class IndexDocumentation {}
