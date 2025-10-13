<?php

namespace App\Docs\Citizens;

/**
 * @OA\Put(
 *     path="/api/citizen/{uuid}",
 *     summary="Atualiza os dados de um cidadão",
 *     tags={"Citizens"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="uuid",
 *         in="path",
 *         required=true,
 *         description="UUID do cidadão",
 *
 *         @OA\Schema(type="string", example="a3f4c9b2-1234-5678-9abc-9876543210ff")
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
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="email", type="string", example="test@test.com"),
 *             @OA\Property(property="telephone", type="string", example="(31) 8730-5567"),
 *             @OA\Property(property="birth_date", type="string", format="date", example="1990-05-15"),
 *             @OA\Property(property="gender", type="string", example="male"),
 *             @OA\Property(property="special_permissions", type="integer", example=0),
 *             @OA\Property(property="can_report_abuse", type="integer", example=0),
 *             @OA\Property(property="can_mobile_castration", type="integer", example=0),
 *             @OA\Property(property="photo", type="string", example="photo.jpg")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Cidadão atualizado com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="uuid", type="string", example="a3f4c9b2-1234-5678-9abc-9876543210ff"),
 *                 @OA\Property(property="email", type="string", example="test@test.com"),
 *                 @OA\Property(property="telephone", type="string", example="(31) 8730-5567"),
 *                 @OA\Property(property="birth_date", type="string", format="date", example="1990-05-15"),
 *                 @OA\Property(property="gender", type="string", example="male"),
 *                 @OA\Property(property="special_permissions", type="integer", example=0),
 *                 @OA\Property(property="can_report_abuse", type="integer", example=0),
 *                 @OA\Property(property="can_mobile_castration", type="integer", example=0),
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class UpdateDocumentation {}
