<?php

namespace App\Docs\Users;

/**
 * @OA\Get(
 *     path="/api/users",
 *     summary="Lista todos os usuários (com ou sem paginação)",
 *     tags={"Users"},
 *
 *     @OA\Parameter(
 *         name="Authorization",
 *         in="header",
 *         required=true,
 *         description="Token JWT. Exemplo: Bearer {token}",
 *
 *         @OA\Schema(type="string", example="Bearer eyJ...token...")
 *     ),
 *
 *     @OA\Parameter(
 *         name="X-Client-Type",
 *         in="header",
 *         required=true,
 *         description="Client type (e.g., web, mobile)",
 *
 *         @OA\Schema(type="string", example="web")
 *     ),
 *
 *     @OA\Parameter(
 *         name="with[]",
 *         in="query",
 *         required=false,
 *         description="Relações a serem carregadas. Ex: status, historyUserStatus",
 *
 *         @OA\Schema(type="string", example="status")
 *     ),
 *
 *     @OA\Parameter(
 *         name="without_pagination",
 *         in="query",
 *         required=false,
 *         description="Se true, desativa a paginação",
 *
 *         @OA\Schema(type="boolean", example=false)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Lista de usuários com ou sem paginação",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="current_page", type="integer", example=1),
 *                 @OA\Property(property="data", type="array",
 *
 *                     @OA\Items(
 *
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="name", type="string", example="Super User"),
 *                         @OA\Property(property="email", type="string", example="super.user@ypet.com"),
 *                         @OA\Property(property="telephone", type="string", example="1234567890"),
 *                         @OA\Property(property="status", type="object",
 *                             @OA\Property(property="status", type="object",
 *                                 @OA\Property(property="value", type="string", example="active"),
 *                                 @OA\Property(property="label", type="string", example="Ativo")
 *                             )
 *                         )
 *                     )
 *                 ),
 *                 @OA\Property(property="total", type="integer", example=1),
 *                 @OA\Property(property="per_page", type="integer", example=20)
 *             ),
 *             @OA\Property(property="show", type="boolean", example=false)
 *         )
 *     )
 * )
 */
class IndexDocumentation {}
