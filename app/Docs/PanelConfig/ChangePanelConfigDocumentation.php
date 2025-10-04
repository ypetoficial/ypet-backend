<?php

namespace App\Docs\PanelConfig;

/**
 * @OA\Put(
 *     path="/api/panel-config",
 *     summary="Altera a senha no painel do usuário logado",
 *     tags={"PanelConfig"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"current_password", "password", "password_confirmation"},
 *
 *             @OA\Property(property="current_password", type="string", example="oldPassword123"),
 *             @OA\Property(property="password", type="string", example="newPassword123"),
 *             @OA\Property(property="password_confirmation", type="string", example="newPassword123")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Senha atualizada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="message", type="string", example="Senha atualizada com sucesso.")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=false)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="A confirmação da nova senha não confere."),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="password",
 *                     type="array",
 *
 *                     @OA\Items(type="string", example="A nova senha deve ter no mínimo 8 caracteres.")
 *                 )
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Acesso negado. Permissão não autorizada.",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Acesso negado. Permissão não autorizada.")
 *         )
 *     )
 * )
 */
class ChangePanelConfigDocumentation {}
