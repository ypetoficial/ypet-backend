<?php

namespace App\Docs\Auth\Register;

/**
 * @OA\Post(
 *     path="/api/auth/register",
 *     summary="Registro de novo usuário",
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
 *             required={"name", "email", "password", "password_confirmation"},
 *
 *             @OA\Property(property="name", type="string", example="Marcus"),
 *             @OA\Property(property="email", type="string", example="marcus@ypet.com"),
 *             @OA\Property(property="password", type="string", example="password"),
 *             @OA\Property(property="password_confirmation", type="string", example="password")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Usuário registrado com sucesso"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Dados inválidos"
 *     )
 * )
 */
class AuthRegisterDocumentation {}
