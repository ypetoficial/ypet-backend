<?php

namespace App\Docs\Registrations;

/**
 * @OA\Get(
 *     path="/api/registrations/{id}",
 *     summary="Exibe os detalhes de uma inscrição",
 *     tags={"Registrations"},
 *
 *     @OA\Parameter(name="id", in="path", required=true, description="ID da inscrição", @OA\Schema(type="integer", example=1)),
 *     @OA\Parameter(name="Authorization", in="header", required=true, description="Token JWT", @OA\Schema(type="string", example="Bearer eyJ...")),
 *     @OA\Parameter(name="X-Client-Type", in="header", required=true, description="Tipo do cliente", @OA\Schema(type="string", example="web")),
 *     @OA\Parameter(name="with[]", in="query", required=false, description="Relações. Ex: mobileClinicEvent, user, animal", @OA\Schema(type="string", example="mobileClinicEvent,user,animal")),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Inscrição encontrada",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="mobile_clinic_event_id", type="integer", example=1),
 *                 @OA\Property(property="user_id", type="integer", example=1),
 *                 @OA\Property(property="animal_id", type="integer", example=1),
 *                 @OA\Property(property="status", type="string", example="confirmed")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class ShowDocumentation {}
