<?php

namespace App\Docs\Supplier;

/**
 * @OA\Put(
 *     path="/api/suppliers/{uuid}",
 *     summary="Update a supplier",
 *     tags={"Suppliers"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(name="uuid", in="path", required=true, description="UUID do fornecedor", @OA\Schema(type="string", example="550e8400-e29b-41d4-a716-446655440000")),
 *     @OA\Parameter(
 *         name="X-Client-Type",
 *         in="header",
 *         required=true,
 *         description="Client type",
 *
 *         @OA\Schema(type="string", example="web")
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"supplier", "contact", "address"},
 *
 *             @OA\Property(
 *                 property="supplier",
 *                 type="object",
 *                 required={"legal_name", "business_name", "document", "representative"},
 *                 @OA\Property(property="legal_name", type="string", example="Acme Corporation Ltda"),
 *                 @OA\Property(property="business_name", type="string", example="Acme Pet Supplies"),
 *                 @OA\Property(property="document", type="string", example="12345678000199"),
 *                 @OA\Property(property="municipal_registration", type="string", example="123456"),
 *                 @OA\Property(property="state_registration", type="string", example="654321"),
 *                 @OA\Property(property="representative", type="string", example="John Doe")
 *             ),
 *             @OA\Property(
 *                 property="contact",
 *                 type="object",
 *                 required={"email", "telephone", "cellphone"},
 *                 @OA\Property(property="email", type="string", example="contact@acmepet.com"),
 *                 @OA\Property(property="telephone", type="string", example="1123456789"),
 *                 @OA\Property(property="cellphone", type="string", example="11987654321")
 *             ),
 *             @OA\Property(
 *                 property="address",
 *                 type="object",
 *                 required={"zip_code", "street", "number", "district", "city", "state"},
 *                 @OA\Property(property="zip_code", type="string", example="01234567"),
 *                 @OA\Property(property="street", type="string", example="Main Street"),
 *                 @OA\Property(property="number", type="string", example="123"),
 *                 @OA\Property(property="complement", type="string", example="Suite 101"),
 *                 @OA\Property(property="district", type="string", example="Downtown"),
 *                 @OA\Property(property="city", type="string", example="São Paulo"),
 *                 @OA\Property(property="state", type="string", example="SP"),
 *                 @OA\Property(property="country", type="string", example="Brazil")
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Supplier registered successfully",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=201),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=2),
 *                 @OA\Property(property="uuid", type="string", example="2f2540fe-e48b-4326-8610-49c34f1455ad"),
 *                 @OA\Property(property="supplier", type="object",
 *                     @OA\Property(property="legal_name", type="string", example="Acme Corporation Ltda"),
 *                     @OA\Property(property="business_name", type="string", example="Acme Pet Supplies"),
 *                     @OA\Property(property="document", type="string", example="12345678000199"),
 *                     @OA\Property(property="municipal_registration", type="string", example="123456"),
 *                     @OA\Property(property="state_registration", type="string", example="654321"),
 *                     @OA\Property(property="representative", type="string", example="John Doe")
 *                 ),
 *                 @OA\Property(property="contact", type="object",
 *                     @OA\Property(property="email", type="string", example="contact@acmepet.com"),
 *                     @OA\Property(property="telephone", type="string", example="1123456789"),
 *                     @OA\Property(property="cellphone", type="string", example="11987654321")
 *                 ),
 *                 @OA\Property(property="address", type="object",
 *                     @OA\Property(property="zip_code", type="string", example="01234567"),
 *                     @OA\Property(property="street", type="string", example="Main Street"),
 *                     @OA\Property(property="number", type="string", example="123"),
 *                     @OA\Property(property="complement", type="string", example="Suite 101"),
 *                     @OA\Property(property="district", type="string", example="Downtown"),
 *                     @OA\Property(property="city", type="string", example="São Paulo"),
 *                     @OA\Property(property="state", type="string", example="SP"),
 *                     @OA\Property(property="country", type="string", example="Brazil")
 *                 ),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-03T02:46:00.000000Z")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class UpdateDocumentation {}
