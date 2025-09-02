<?php

namespace App\Docs\MobileClinicEvents;

/**
 * @OA\Get(
 *     path="/api/mobile-clinic-events/{id}",
 *     summary="Exibe os detalhes de um evento de clínica móvel",
 *     tags={"Mobile Clinic Events"},
 *
 *     @OA\Parameter(name="id", in="path", required=true, description="ID do evento", @OA\Schema(type="integer", example=1)),
 *     @OA\Parameter(name="Authorization", in="header", required=true, description="Token JWT", @OA\Schema(type="string", example="Bearer eyJ...")),
 *     @OA\Parameter(name="X-Client-Type", in="header", required=true, description="Tipo do cliente", @OA\Schema(type="string", example="web")),
 *     @OA\Parameter(name="with[]", in="query", required=false, description="Relações. Ex: registrations", @OA\Schema(type="string", example="registrations")),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Evento encontrado",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Clínica Móvel Centro"),
 *                 @OA\Property(property="description", type="string", example="Evento de castração gratuita"),
 *                 @OA\Property(property="location", type="string", example="Praça Central"),
 *                 @OA\Property(property="start_date", type="string", format="date-time", example="2024-01-15 08:00:00"),
 *                 @OA\Property(property="end_date", type="string", format="date-time", example="2024-01-15 17:00:00"),
 *                 @OA\Property(property="status", type="string", example="active")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class ShowDocumentation {}
