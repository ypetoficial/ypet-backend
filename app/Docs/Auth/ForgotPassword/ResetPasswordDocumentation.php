<?php

namespace App\Docs\Auth\ForgotPassword;

/**
 * @OA\Post(
 *     path="/api/auth/reset-password",
 *     summary="Redefine a senha do usuário",
 *     tags={"Auth"},
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
 *             required={"token", "email", "password", "password_confirmation"},
 *
 *             @OA\Property(property="token", type="string", example="a3186bb5497..."),
 *             @OA\Property(property="email", type="string", example="marcus2@ypet.com"),
 *             @OA\Property(property="password", type="string", example="teste123"),
 *             @OA\Property(property="password_confirmation", type="string", example="teste123")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Senha redefinida com sucesso"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação"
 *     )
 * )
 */
class ResetPasswordDocumentation {}
