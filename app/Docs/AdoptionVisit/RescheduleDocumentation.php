<?php

namespace App\Docs\AdoptionVisit;

/**
 * @OA\Post(
 *     path="/api/adoption-visits/{uuid}/reschedule",
 *     summary="Reagenda uma visita de adoção",
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
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"start_date"},
 *
 *             @OA\Property(property="start_date", type="string", format="date", example="2025-09-15")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Visita de adoção reagendada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="message", type="string", example="Visita remarcada com sucesso"),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class RescheduleDocumentation {}
