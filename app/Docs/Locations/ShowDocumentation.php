<?php

namespace App\Docs\Locations;

/**
 * @OA\Get(
 *     path="/api/location/{uuid}",
 *     summary="Exibe os detalhes de um local",
 *     tags={"Locations"},
 *     security={{"bearerAuth": {}}},
 *
 *     @OA\Parameter(
 *         name="uuid",
 *         in="path",
 *         required=true,
 *         description="UUID do local",
 *
 *         @OA\Schema(type="string", example="4a65ca27-b40a-4a53-8fcc-cdfa4c5063b3")
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
 *         description="Local encontrado com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="uuid", type="string", example="4a65ca27-b40a-4a53-8fcc-cdfa4c5063b3"),
 *                 @OA\Property(property="location_name", type="string", example="Happy Paws Shelter"),
 *                 @OA\Property(property="location_type", type="string", example="pet_hotel"),
 *                 @OA\Property(property="responsible_name", type="string", example="Daniel Andrade"),
 *                 @OA\Property(property="phone", type="string", example="31987654321"),
 *                 @OA\Property(property="email", type="string", example="contact@happypawss.com"),
 *                 @OA\Property(property="cnpj", type="string", nullable=true, example=null),
 *                 @OA\Property(property="bank_account_or_pix", type="string", nullable=true, example=null),
 *                 @OA\Property(property="status", type="integer", example=1),
 *                 @OA\Property(property="notes", type="string", example="Local especializado em hospedagem e cuidados temporários de animais resgatados."),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-16T16:34:36.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-16T16:34:36.000000Z")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=false)
 *         )
 *     )
 * )
 */
class ShowDocumentation {}
