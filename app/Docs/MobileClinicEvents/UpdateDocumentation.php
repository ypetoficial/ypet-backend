<?php

namespace App\Docs\MobileClinicEvents;

/**
 * @OA\Put(
 *     path="/api/mobile-clinic-events/{id}",
 *     summary="Atualiza os dados de um evento de clínica móvel",
 *     tags={"Mobile Clinic Events"},
 *
 *     @OA\Parameter(name="id", in="path", required=true, description="ID do evento", @OA\Schema(type="integer", example=1)),
 *     @OA\Parameter(name="Authorization", in="header", required=true, description="Token JWT", @OA\Schema(type="string", example="Bearer eyJ...")),
 *     @OA\Parameter(name="X-Client-Type", in="header", required=true, description="Tipo do cliente", @OA\Schema(type="string", example="web")),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="name", type="string", example="Clínica Móvel Centro Atualizada"),
 *             @OA\Property(property="description", type="string", example="Evento de castração e vacinação gratuita"),
 *             @OA\Property(property="status", type="string", example="active")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Evento atualizado com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Clínica Móvel Centro Atualizada")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class UpdateDocumentation {}
