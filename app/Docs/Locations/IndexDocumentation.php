<?php

namespace App\Docs\Locations;

/**
 * @OA\Get(
 *     path="/api/location",
 *     summary="Lista todos os locais cadastrados",
 *     tags={"Locations"},
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
 *     @OA\Response(
 *         response=200,
 *         description="Lista de locais retornada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="message", type="string", example="Operação realizada com com sucesso"),
 *             @OA\Property(property="show", type="boolean", example=true),
 *             @OA\Property(
 *                 property="response",
 *                 type="array",
 *
 *                 @OA\Items(
 *
 *                     @OA\Property(property="id", type="integer", example=2),
 *                     @OA\Property(property="uuid", type="string", example="3ab7d7ef-4582-4c5a-8f50-74a6f1ab1fbd"),
 *                     @OA\Property(property="location_name", type="string", example="Happy Paws Shelter"),
 *                     @OA\Property(property="location_type", type="string", example="pet_hotel"),
 *                     @OA\Property(property="responsible_name", type="string", example="Daniel Andrade"),
 *                     @OA\Property(property="email", type="string", example="contact@happypawssq.com"),
 *                     @OA\Property(property="phone", type="string", example="31987654321"),
 *                     @OA\Property(property="status", type="integer", example=1),
 *                     @OA\Property(property="notes", type="string", example="Local especializado em hospedagem e cuidados temporários de animais resgatados."),
 *                     @OA\Property(property="cnpj", type="string", example="12.345.678/0001-99"),
 *                     @OA\Property(property="bank_account_or_pix", type="string", example="contato@happypawssq.com"),
 *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-16T17:06:42.000000Z"),
 *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-16T17:06:42.000000Z"),
 *                     @OA\Property(
 *                         property="address",
 *                         type="array",
 *
 *                         @OA\Items(
 *
 *                             @OA\Property(property="zipcode", type="string", example="35000-000"),
 *                             @OA\Property(property="street", type="string", example="Rua das Palmeiras"),
 *                             @OA\Property(property="number", type="string", example="120"),
 *                             @OA\Property(property="complement", type="string", example="Casa 2"),
 *                             @OA\Property(property="neighborhood", type="string", example="Jardim Alice"),
 *                             @OA\Property(property="city", type="string", example="Governador Valadares"),
 *                             @OA\Property(property="state", type="string", example="MG")
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     )
 * )
 */
class IndexDocumentation {}
