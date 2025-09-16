<?php

namespace App\Docs\Protector;

/**
 * @OA\Get(
 *     path="/api/protector",
 *     summary="Lista todos os protetores",
 *     tags={"Protectors"},
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
 *         description="Lista de Protetores retornada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *
 *                 @OA\Items(
 *
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="uuid", type="string", example="901f1ef6-8352-415a-b91c-cba470fe66f5"),
 *                     @OA\Property(property="birth_date", type="string", format="date", example="1990-05-15"),
 *                     @OA\Property(property="gender", type="string", example="1tsfas"),
 *                     @OA\Property(property="special_permissions", type="integer", example=1),
 *                     @OA\Property(property="document", type="string", example="123456789S1"),
 *                     @OA\Property(property="status", type="integer", example=0),
 *                     @OA\Property(property="pet_status", type="string", nullable=true, example=null),
 *                     @OA\Property(property="updated_by", type="integer", example=2),
 *                     @OA\Property(property="observations", type="string", nullable=true, example=null),
 *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-03T03:45:00.000000Z"),

 *                 )
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class IndexDocumentation {}
