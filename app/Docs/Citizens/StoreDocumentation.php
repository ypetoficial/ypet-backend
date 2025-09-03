<?php

namespace App\Docs\Citizens;

/**
 * @OA\Post(
 *     path="/api/citizen",
 *     summary="Cadastra um novo cidadão",
 *     tags={"Citizens"},
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
 *             required={"name", "document", "email", "phone", "birth_date", "gender", "status", "address", "tenant_id"},
 *
 *             @OA\Property(property="name", type="string", example="Paulo"),
 *             @OA\Property(property="document", type="string", example="12345678910"),
 *             @OA\Property(property="email", type="string", example="test@test.comm"),
 *             @OA\Property(property="phone", type="string", example="(31) 98765-4321"),
 *             @OA\Property(property="birth_date", type="string", format="date", example="1990-05-15"),
 *             @OA\Property(property="gender", type="string", example="male"),
 *             @OA\Property(property="special_permissions", type="integer", example=1),
 *             @OA\Property(property="can_report_abuse", type="integer", example=1),
 *             @OA\Property(property="can_mobile_castration", type="integer", example=1),
 *             @OA\Property(property="status", type="integer", example=1),
 *             @OA\Property(
 *                 property="address",
 *                 type="object",
 *                 required={"type", "zipcode", "street", "number", "neighborhood", "city", "state"},
 *                 @OA\Property(property="type", type="integer", example=0),
 *                 @OA\Property(property="zipcode", type="string", example="35010-600"),
 *                 @OA\Property(property="street", type="string", example="Rua Flores"),
 *                 @OA\Property(property="number", type="string", example="123"),
 *                 @OA\Property(property="complement", type="string", example="Apto 202"),
 *                 @OA\Property(property="neighborhood", type="string", example="Centro"),
 *                 @OA\Property(property="city", type="string", example="Governador Valadares"),
 *                 @OA\Property(property="state", type="string", example="MG")
 *             ),
 *             @OA\Property(property="tenant_id", type="integer", example=1),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Cidadão cadastrado com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=201),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=10),
 *                 @OA\Property(property="name", type="string", example="Paulo"),
 *                 @OA\Property(property="document", type="string", example="12345678910"),
 *                 @OA\Property(property="email", type="string", example="test@test.com")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class StoreDocumentation {}
