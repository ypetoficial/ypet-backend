<?php

namespace App\Docs\Users;

/**
 * @OA\Put(
 *     path="/api/users/{id}",
 *     summary="Atualiza os dados de um usuário",
 *     tags={"Users"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID do usuário",
 *
 *         @OA\Schema(type="integer", example=2)
 *     ),
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
 *
 *             @OA\Property(property="name", type="string", example="Maria H. Atualizada"),
 *             @OA\Property(property="password", type="string", example="novaSenha123"),
 *             @OA\Property(property="telephone", type="string", example="11999999999")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Usuário atualizado com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=2),
 *                 @OA\Property(property="name", type="string", example="Maria H. Atualizada"),
 *                 @OA\Property(property="email", type="string", example="maria.helena@test.com")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Usuário não encontrado"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação"
 *     )
 * )
 */
class UpdateDocumentation {}
