<?php

namespace App\Docs\Auth\Login;

/**
 * @OA\Post(
 *     path="/api/auth/logout-all",
 *     summary="Logout em todos os dispositivos",
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
 *         description="Logout de todas as sessões realizado com sucesso"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Não autenticado"
 *     )
 * )
 */
class AuthLogoutAllDocumentation {}
