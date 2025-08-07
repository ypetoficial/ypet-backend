<?php

namespace App\Docs\Auth\Login;

/**
 * @OA\Info(
 *     title="YPet API",
 *     version="1.0.0",
 *     description="Documentação da API do sistema YPet"
 * )
 */

/**
 * @OA\Post(
 *     path="/api/auth/login",
 *     summary="Login do usuário",
 *     tags={"Auth"},
 *
 *     @OA\Parameter(
 *          name="X-Client-Type",
 *          in="header",
 *          required=true,
 *          description="Client type (e.g., web, mobile)",
 *
 *          @OA\Schema(type="string", example="web")
 *      ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"email","password"},
 *
 *             @OA\Property(property="email", type="string", example="super.user@ypet.com"),
 *             @OA\Property(property="password", type="string", example="password")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Login realizado com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="access_token", type="string"),
 *             @OA\Property(property="token_type", type="string"),
 *             @OA\Property(property="expires_in", type="integer")
 *         )
 *     )
 * )
 */
class AuthLoginDocumentation {}
