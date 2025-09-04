<?php

namespace App\Docs\Registrations;

/**
 * @OA\Post(
 *     path="/api/registrations",
 *     summary="Cadastra uma nova inscrição",
 *     tags={"Registrations"},
 *
 *     @OA\Parameter(name="Authorization", in="header", required=true, description="Token JWT", @OA\Schema(type="string", example="Bearer eyJ...")),
 *     @OA\Parameter(name="X-Client-Type", in="header", required=true, description="Tipo do cliente", @OA\Schema(type="string", example="web")),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"mobile_clinic_event_id", "user_id", "animal_id", "status"},
 *
 *             @OA\Property(property="mobile_clinic_event_id", type="integer", example=1),
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="animal_id", type="integer", example=1),
 *             @OA\Property(property="status", type="string", example="pending")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Inscrição cadastrada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=201),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="response", type="object",
 *                     @OA\Property(property="id", type="integer", example=5),
 *                     @OA\Property(property="mobile_clinic_event_id", type="integer", example=1),
 *                     @OA\Property(property="user_id", type="integer", example=1),
 *                     @OA\Property(property="animal_id", type="integer", example=1)
 *                 )
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class StoreDocumentation {}
