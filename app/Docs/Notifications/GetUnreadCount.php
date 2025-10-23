<?php

namespace App\Docs\Notifications;

/**
 * @OA\Get(
 *     path="/api/notifications/unread-count",
 *     summary="Contar notificações não lidas",
 *     description="Retorna o número total de notificações não lidas do usuário autenticado",
 *     operationId="getUnreadNotificationsCount",
 *     tags={"Notifications"},
 *     security={{"bearerAuth": {}}},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Contagem de notificações não lidas recuperada com sucesso",
 *
 *         @OA\JsonContent(ref="#/components/schemas/UnreadCount")
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
class GetUnreadCount
{
    // Esta classe existe apenas para conter a documentação do endpoint
}
