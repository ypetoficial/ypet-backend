<?php

namespace App\Docs\Auth\Me;

/**
 * @OA\Put(
 *     path="/api/auth/me/password",
 *     summary="Atualiza a senha do usuário autenticado",
 *     tags={"Auth"},
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
 *             required={"current_password", "password", "password_confirmation"},
 *
 *             @OA\Property(property="current_password", type="string", example="senhaAtual123"),
 *             @OA\Property(property="password", type="string", example="novaSenha456"),
 *             @OA\Property(property="password_confirmation", type="string", example="novaSenha456")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Senha atualizada com sucesso"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Não autenticado"
 *     )
 * )
 */
class MePasswordDocumentation {}
