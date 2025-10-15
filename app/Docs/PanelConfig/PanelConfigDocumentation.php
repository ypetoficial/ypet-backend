<?php

namespace App\Docs\PanelConfig;

/**
 * @OA\Get(
 *     path="/api/panel-config",
 *     summary="Exibe as configurações do painel do usuário logado",
 *     tags={"PanelConfig"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Configurações do usuário retornadas com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(
 *                 property="user",
 *                 type="object",
 *                 @OA\Property(property="name", type="string", example="Super User"),
 *                 @OA\Property(property="email", type="string", example="super.user@ypet.com"),
 *                 @OA\Property(property="password", type="string", example="passwordFake"),
 *                 @OA\Property(property="city", type="string", example="Governador Valadares"),
 *                 @OA\Property(property="state", type="string", example="MG"),
 *                 @OA\Property(property="timezone", type="string", example="America/Rio_Branco")
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
class PanelConfigDocumentation {}
