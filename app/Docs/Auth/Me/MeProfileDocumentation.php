<?php

namespace App\Docs\Auth\Me;

/**
 * @OA\Put(
 *     path="/api/auth/me/profile",
 *     summary="Atualiza o perfil do usuário autenticado",
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
 *             required={"name", "email"},
 *
 *             @OA\Property(property="name", type="string", example="Marcus Silva"),
 *             @OA\Property(property="email", type="string", example="marcus@ypet.com")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Perfil atualizado com sucesso"
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
class MeProfileDocumentation {}
