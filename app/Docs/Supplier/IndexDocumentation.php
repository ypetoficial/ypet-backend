<?php

namespace App\Docs\Supplier;

/**
 * @OA\Get(
 *     path="/api/suppliers",
 *     summary="Lista fornecedores",
 *     tags={"Suppliers"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="representative",
 *         in="query",
 *         required=false,
 *         description="Filtrar por representante",
 *
 *         @OA\Schema(type="string", example="John Doe")
 *     ),
 *
 *     @OA\Parameter(
 *         name="document",
 *         in="query",
 *         required=false,
 *         description="Filtrar por documento (CNPJ)",
 *
 *         @OA\Schema(type="string", example="12345678000199")
 *     ),
 *
 *     @OA\Parameter(
 *         name="legal_name",
 *         in="query",
 *         required=false,
 *         description="Filtrar por razão social",
 *
 *         @OA\Schema(type="string", example="Acme Corporation Ltda")
 *     ),
 *
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
 *         description="Lista de fornecedores",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="current_page", type="integer", example=1),
 *                 @OA\Property(
 *                     property="data",
 *                     type="array",
 *
 *                     @OA\Items(
 *                         type="object",
 *
 *                         @OA\Property(property="uuid", type="string", example="d3d8dfca-16e2-455b-948b-24e88bb36a14"),
 *                         @OA\Property(property="status", type="integer", example=1),
 *                         @OA\Property(property="legal_name", type="string", example="Acme Corporation Ltda"),
 *                         @OA\Property(property="business_name", type="string", example="Acme Pet Supplies"),
 *                         @OA\Property(property="document", type="string", example="12345678000199"),
 *                         @OA\Property(property="municipal_registration", type="string", example="123456"),
 *                         @OA\Property(property="state_registration", type="string", example="654321"),
 *                         @OA\Property(property="representative", type="string", example="John Doe"),
 *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-13T22:22:15.000000Z"),
 *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-13T22:22:15.000000Z")
 *                     )
 *                 ),
 *                 @OA\Property(property="first_page_url", type="string", example="http://localhost:8000/api/suppliers?document=12345678000199&page=1"),
 *                 @OA\Property(property="from", type="integer", example=1),
 *                 @OA\Property(property="last_page", type="integer", example=1),
 *                 @OA\Property(property="last_page_url", type="string", example="http://localhost:8000/api/suppliers?document=12345678000199&page=1"),
 *                 @OA\Property(
 *                     property="links",
 *                     type="array",
 *
 *                     @OA\Items(
 *                         type="object",
 *
 *                         @OA\Property(property="url", type="string", example=null),
 *                         @OA\Property(property="label", type="string", example="pagination.previous"),
 *                         @OA\Property(property="active", type="boolean", example=false)
 *                     )
 *                 ),
 *                 @OA\Property(property="next_page_url", type="string", example=null),
 *                 @OA\Property(property="path", type="string", example="http://localhost:8000/api/suppliers"),
 *                 @OA\Property(property="per_page", type="integer", example=20),
 *                 @OA\Property(property="prev_page_url", type="string", example=null),
 *                 @OA\Property(property="to", type="integer", example=6),
 *                 @OA\Property(property="total", type="integer", example=6)
 *             ),
 *             @OA\Property(property="show", type="boolean", example=false)
 *         )
 *     )
 * )
 */
class IndexDocumentation {}
