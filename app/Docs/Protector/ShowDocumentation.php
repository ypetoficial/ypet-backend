<?php

namespace App\Docs\Protector;

/**
 * @OA\Get(
 *     path="/api/protector/{uuid}",
 *     summary="Exibe os detalhes de um protetor",
 *     tags={"Protectors"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="uuid",
 *         in="path",
 *         required=true,
 *         description="UUID do protetor",
 *         @OA\Schema(type="string", example="e68023dc-f657-45b5-bded-62fc80b76036")
 *     ),
 *     @OA\Parameter(
 *         name="X-Client-Type",
 *         in="header",
 *         required=true,
 *         description="Tipo do cliente",
 *         @OA\Schema(type="string", example="web")
 *     ),
 *     @OA\Parameter(
 *         name="with[]",
 *         in="query",
 *         required=false,
 *         description="Relações para carregar. Ex: address, company, tenant",
 *         @OA\Schema(type="string", example="address")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Protetor encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="uuid", type="integer", example="e68023dc-f657-45b5-bded-62fc80b76036"),
 *                 @OA\Property(property="name", type="string", example="Paulo"),
 *                 @OA\Property(property="document", type="string", example="12345678910"),
 *                 @OA\Property(property="email", type="string", example="test@test.com"),
 *                 @OA\Property(property="phone", type="string", example="(31) 98765-4321"),
 *                 @OA\Property(property="birth_date", type="string", format="date", example="1990-05-15"),
 *                 @OA\Property(property="gender", type="string", example="male"),
 *                 @OA\Property(property="status", type="integer", example=1),
 *                 @OA\Property(
 *                     property="address",
 *                     type="object",
 *                     @OA\Property(property="zipcode", type="string", example="35010-600"),
 *                     @OA\Property(property="street", type="string", example="Rua Flores"),
 *                     @OA\Property(property="number", type="string", example="123"),
 *                     @OA\Property(property="neighborhood", type="string", example="Centro"),
 *                     @OA\Property(property="city", type="string", example="Governador Valadares"),
 *                     @OA\Property(property="state", type="string", example="MG")
 *                 )
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class ShowDocumentation {}
