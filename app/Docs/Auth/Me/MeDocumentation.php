<?php

namespace App\Docs\Auth\Me;

/**
 * @OA\Get(
 *     path="/api/auth/me",
 *     summary="Retorna os dados do usuário autenticado",
 *     tags={"Auth"},
 *
 *     @OA\Parameter(
 *          name="Authorization",
 *          in="header",
 *          required=true,
 *          description="Token JWT. Exemplo: Bearer {token}",
 *
 *          @OA\Schema(type="string", example="Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...")
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
 *     @OA\Response(
 *         response=200,
 *         description="Dados do usuário retornados com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="Marcus Silva"),
 *             @OA\Property(property="email", type="string", example="marcus@ypet.com"),
 *             @OA\Property(property="status", type="string", example="active")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Não autenticado"
 *     )
 * )
 */
class MeDocumentation {}
