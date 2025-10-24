<?php

namespace App\Docs\Notifications;

/**
 * @OA\Get(
 *     path="/api/notifications",
 *     summary="Listar notificações do usuário",
 *     description="Retorna uma lista paginada das notificações do usuário autenticado, ordenadas por data de criação (mais recentes primeiro)",
 *     operationId="getNotifications",
 *     tags={"Notifications"},
 *     security={{"bearerAuth": {}}},
 *
 *     @OA\Parameter(
 *         name="per_page",
 *         in="query",
 *         description="Número de itens por página (máximo 100)",
 *         required=false,
 *
 *         @OA\Schema(type="integer", default=20, minimum=1, maximum=100)
 *     ),
 *
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="Página atual",
 *         required=false,
 *
 *         @OA\Schema(type="integer", default=1, minimum=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Lista de notificações recuperada com sucesso",
 *
 *         @OA\JsonContent(ref="#/components/schemas/NotificationList")
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Não autorizado - Token inválido ou ausente",
 *
 *         @OA\JsonContent(ref="#/components/schemas/NotificationErrorResponse")
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno do servidor",
 *
 *         @OA\JsonContent(ref="#/components/schemas/NotificationErrorResponse")
 *     )
 * )
 */
class GetNotifications
{
    // Esta classe existe apenas para conter a documentação do endpoint
}
