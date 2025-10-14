<?php

namespace App\Docs\Supplier;

/**
 * @OA\Get(
 *     path="/api/suppliers/{uuid}",
 *     summary="Exibe os detalhes de um fornecedor",
 *     tags={"Suppliers"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(name="uuid", in="path", required=true, description="UUID do fornecedor", @OA\Schema(type="string", example="550e8400-e29b-41d4-a716-446655440000")),
 *     @OA\Parameter(name="X-Client-Type", in="header", required=true, description="Tipo do cliente", @OA\Schema(type="string", example="web")),
 *     @OA\Parameter(
 *         name="with[]",
 *         in="query",
 *         required=false,
 *         description="Relações. Ex: contacts, addresses",
 *
 *         @OA\Schema(
 *             type="array",
 *
 *             @OA\Items(type="string", example="contacts")
 *         ),
 *         style="form",
 *         explode=true,
 *         example={"contacts","addresses"}
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Fornecedor encontrado",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="uuid", type="string", example="d21d02ec-177a-45a3-b197-3d9752a027c5"),
 *                 @OA\Property(property="status", type="integer", example=1),
 *                 @OA\Property(property="legal_name", type="string", example="Update Corporation Ltda"),
 *                 @OA\Property(property="business_name", type="string", example="Update Acme Pet Supplies"),
 *                 @OA\Property(property="document", type="string", example="12345678000198"),
 *                 @OA\Property(property="municipal_registration", type="string", example="888"),
 *                 @OA\Property(property="state_registration", type="string", example="999"),
 *                 @OA\Property(property="representative", type="string", example="John Doe Editado"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-13T23:11:58.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-14T10:27:30.000000Z"),
 *                 @OA\Property(
 *                     property="contacts",
 *                     type="array",
 *
 *                     @OA\Items(
 *                         type="object",
 *
 *                         @OA\Property(property="id", type="integer", example=2),
 *                         @OA\Property(property="uuid", type="string", example="c933e0f4-ef6c-448c-b4a5-1c80adfde80b"),
 *                         @OA\Property(property="contactable_type", type="string", example="App\\Domains\\Supplier\\Entities\\SupplierEntity"),
 *                         @OA\Property(property="contactable_id", type="integer", example=14),
 *                         @OA\Property(property="email", type="string", example="contact@acmepet.com"),
 *                         @OA\Property(property="telephone", type="string", example="1123456789"),
 *                         @OA\Property(property="cellphone", type="string", example="11987654321"),
 *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-13T23:11:58.000000Z"),
 *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-13T23:11:58.000000Z")
 *                     )
 *                 ),
 *                 @OA\Property(
 *                     property="addresses",
 *                     type="array",
 *
 *                     @OA\Items(
 *                         type="object",
 *
 *                         @OA\Property(property="id", type="integer", example=4),
 *                         @OA\Property(property="addressable_type", type="string", example="App\\Domains\\Supplier\\Entities\\SupplierEntity"),
 *                         @OA\Property(property="addressable_id", type="integer", example=14),
 *                         @OA\Property(property="street", type="string", example="Main Street"),
 *                         @OA\Property(property="number", type="string", example="123"),
 *                         @OA\Property(property="complement", type="string", example="Suite 101"),
 *                         @OA\Property(property="district", type="string", example="Downtown"),
 *                         @OA\Property(property="city", type="string", example="São Paulo"),
 *                         @OA\Property(property="state", type="string", example="SP"),
 *                         @OA\Property(property="zip_code", type="string", example="01234567"),
 *                         @OA\Property(property="country", type="string", example="Brazil"),
 *                         @OA\Property(property="latitude", type="number", example=null),
 *                         @OA\Property(property="longitude", type="number", example=null),
 *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-13T23:11:58.000000Z"),
 *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-13T23:11:58.000000Z")
 *                     )
 *                 )
 *             ),
 *             @OA\Property(property="show", type="boolean", example=false)
 *         )
 *     )
 * )
 */
class ShowDocumentation {}
