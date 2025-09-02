<?php

namespace App\Docs\MobileClinicEvents;

/**
 * @OA\Get(
 *     path="/api/mobile-clinic-events",
 *     summary="Lista todos os eventos de clínica móvel (com ou sem paginação)",
 *     tags={"Mobile Clinic Events"},
 *
 *     @OA\Parameter(
 *         name="Authorization",
 *         in="header",
 *         required=true,
 *         description="Token JWT. Exemplo: Bearer {token}",
 *
 *         @OA\Schema(type="string", example="Bearer eyJ...token...")
 *     ),
 *
 *     @OA\Parameter(
 *         name="X-Client-Type",
 *         in="header",
 *         required=true,
 *         description="Client type (e.g., web, mobile)",
 *
 *         @OA\Schema(type="string", example="web")
 *     ),
 *
 *     @OA\Parameter(
 *         name="with[]",
 *         in="query",
 *         required=false,
 *         description="Relações a serem carregadas",
 *
 *         @OA\Schema(type="string", example="registrations")
 *     ),
 *
 *     @OA\Parameter(
 *         name="without_pagination",
 *         in="query",
 *         required=false,
 *         description="Se true, desativa a paginação",
 *
 *         @OA\Schema(type="boolean", example=false)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Lista de eventos retornada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="current_page", type="integer", example=1),
 *                 @OA\Property(property="data", type="array",
 *
 *                     @OA\Items(
 *
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="name", type="string", example="Clínica Móvel Centro"),
 *                         @OA\Property(property="description", type="string", example="Evento de castração gratuita"),
 *                         @OA\Property(property="location", type="string", example="Praça Central"),
 *                         @OA\Property(property="start_date", type="string", format="date-time", example="2024-01-15 08:00:00"),
 *                         @OA\Property(property="end_date", type="string", format="date-time", example="2024-01-15 17:00:00"),
 *                         @OA\Property(property="status", type="string", example="active")
 *                     )
 *                 ),
 *                 @OA\Property(property="total", type="integer", example=1)
 *             ),
 *             @OA\Property(property="show", type="boolean", example=false)
 *         )
 *     )
 * )
 */
class IndexDocumentation {}
