<?php

namespace App\Docs\Auth\ForgotPassword;

/**
 * @OA\Post(
 *     path="/api/auth/forgot-password",
 *     summary="Solicita redefinição de senha",
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
 *             required={"email"},
 *
 *             @OA\Property(property="email", type="string", example="marcus2@ypet.com")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="E-mail de redefinição enviado com sucesso"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação"
 *     )
 * )
 */
class ForgotPasswordDocumentation {}
