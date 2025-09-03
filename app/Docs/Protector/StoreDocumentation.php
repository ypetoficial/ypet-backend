<?php

namespace App\Docs\Protector;

/**
 * @OA\Post(
 *     path="/api/protector",
 *     summary="Cadastra um novo protetor",
 *     tags={"Protectors"},
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
 *             required={"name", "document", "email", "telephone", "birth_date", "gender", "status", "address"},
 *
 *             @OA\Property(property="name", type="string", example="Paulo"),
 *             @OA\Property(property="document", type="string", example="12345678910"),
 *             @OA\Property(property="email", type="string", example="test@test.comm"),
 *             @OA\Property(property="telephone", type="string", example="(31) 98765-4321"),
 *             @OA\Property(property="birth_date", type="string", format="date", example="1990-05-15"),
 *             @OA\Property(property="gender", type="string", example="male"),
 *             @OA\Property(property="special_permissions", type="integer", example=1),
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
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Protetor cadastrado com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=201),
 *             @OA\Property(property="data", type="object",
 *                     @OA\Property(property="id", type="integer", example=2),
 *                     @OA\Property(property="uuid", type="string", example="2f2540fe-e48b-4326-8610-49c34f1455ad"),
 *                     @OA\Property(property="document", type="string", example="57146468543"),
 *                     @OA\Property(property="birth_date", type="string", format="date", example="1990-05-15"),
 *                     @OA\Property(property="gender", type="string", example="test"),
 *                     @OA\Property(property="special_permissions", type="integer", example=1),
 *                     @OA\Property(property="status", type="integer", example=1),
 *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-03T02:46:00.000000Z"),

 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class StoreDocumentation {}
