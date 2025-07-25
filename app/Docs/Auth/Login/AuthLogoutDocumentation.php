<?php

namespace App\Docs\Auth\Login;

/**
 * @OA\Post(
 *     path="/api/auth/logout",
 *     summary="Logout do usuário",
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
 *     @OA\Response(
 *         response=200,
 *         description="Logout realizado com sucesso"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Não autenticado"
 *     )
 * )
 */
class AuthLogoutDocumentation {}
