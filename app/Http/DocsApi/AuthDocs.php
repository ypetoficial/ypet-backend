<?php

namespace App\Http\DocsApi;

use App\Http\Controllers\AuthController;

class AuthDocs extends AuthController
{
    /**
     * @OA\Post(
     *     path="/auth/login",
     *     summary="Login do usuário",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", example="user@email.com"),
     *             @OA\Property(property="password", type="string", example="secret")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login realizado com sucesso."
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação."
     *     )
     * )
     */
    public function loginDocs() {}

    /**
     * @OA\Get(
     *     path="/auth/me",
     *     summary="Usuário autenticado",
     *     tags={"Auth"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Usuário autenticado."
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não autenticado."
     *     )
     * )
     */
    public function meDocs() {}

    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     summary="Logout do usuário",
     *     tags={"Auth"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Logout realizado com sucesso."
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não autenticado."
     *     )
     * )
     */
    public function logoutDocs() {}

    /**
     * @OA\Post(
     *     path="/auth/forget-password",
     *     summary="Solicita redefinição de senha",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email"},
     *             @OA\Property(property="email", type="string", example="user@email.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Link enviado."
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação."
     *     )
     * )
     */
    public function forgetPasswordDocs() {}

    /**
     * @OA\Post(
     *     path="/auth/reset-password",
     *     summary="Reseta a senha do usuário",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password", "token"},
     *             @OA\Property(property="email", type="string", example="user@email.com"),
     *             @OA\Property(property="password", type="string", example="novaSenha"),
     *             @OA\Property(property="token", type="string", example="token.aqui")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Senha redefinida com sucesso."
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação."
     *     )
     * )
     */
    public function resetPasswordDocs() {}
}
