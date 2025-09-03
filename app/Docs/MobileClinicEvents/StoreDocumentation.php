<?php

namespace App\Docs\MobileClinicEvents;

/**
 * @OA\Post(
 *     path="/api/mobile-clinic-events",
 *     summary="Cadastra um novo evento de clínica móvel",
 *     tags={"Mobile Clinic Events"},
 *
 *     @OA\Parameter(name="Authorization", in="header", required=true, description="Token JWT", @OA\Schema(type="string", example="Bearer eyJ...")),
 *     @OA\Parameter(name="X-Client-Type", in="header", required=true, description="Tipo do cliente", @OA\Schema(type="string", example="web")),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"name", "location", "start_date", "end_date", "status"},
 *
 *             @OA\Property(property="name", type="string", example="Clínica Móvel Centro"),
 *             @OA\Property(property="description", type="string", example="Evento de castração gratuita"),
 *             @OA\Property(property="location", type="string", example="Praça Central"),
 *             @OA\Property(property="start_date", type="string", format="date-time", example="2024-01-15 08:00:00"),
 *             @OA\Property(property="end_date", type="string", format="date-time", example="2024-01-15 17:00:00"),
 *             @OA\Property(property="status", type="string", example="active"),
 *             @OA\Property(property="species", type="array", @OA\Items(type="string"), example={"dog", "cat"}),
 *             @OA\Property(property="gender", type="array", @OA\Items(type="string"), example={"male", "female"})
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Evento cadastrado com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=201),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="response", type="object",
 *                     @OA\Property(property="id", type="integer", example=5),
 *                     @OA\Property(property="name", type="string", example="Clínica Móvel Centro")
 *                 )
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class StoreDocumentation {}
