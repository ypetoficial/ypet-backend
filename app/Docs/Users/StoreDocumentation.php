<?php

namespace App\Docs\Users;

/**
 * @OA\Post(
 *     path="/api/users",
 *     summary="Cria um novo usuário",
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
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"name", "email", "password", "password_confirmation", "status", "roles"},
 *
 *             @OA\Property(property="name", type="string", example="Maria Helena"),
 *             @OA\Property(property="email", type="string", example="maria.helena@test.com"),
 *             @OA\Property(property="password", type="string", example="password"),
 *             @OA\Property(property="password_confirmation", type="string", example="password"),
 *             @OA\Property(property="status", type="string", example="active"),
 *             @OA\Property(property="roles", type="array", @OA\Items(type="string"), example={"user_administrator", "superuser"})
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Usuário criado com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=201),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=2),
 *                 @OA\Property(property="name", type="string", example="Maria Helena"),
 *                 @OA\Property(property="email", type="string", example="maria.helena@test.com")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação"
 *     )
 * )
 */
class StoreDocumentation {}
