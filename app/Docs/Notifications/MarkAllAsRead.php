<?php

namespace App\Docs\Notifications;

/**
 * @OA\Patch(
 *     path="/api/notifications/mark-all-read",
 *     summary="Marcar todas as notificações como lidas",
 *     description="Marca todas as notificações não lidas do usuário autenticado como lidas",
 *     operationId="markAllNotificationsAsRead",
 *     tags={"Notifications"},
 *     security={{"bearerAuth": {}}},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Todas as notificações marcadas como lidas com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", description="Status da operação", example=true),
 *             @OA\Property(property="message", type="string", description="Mensagem de sucesso", example="Todas as notificações foram marcadas como lidas"),
 *             @OA\Property(property="count", type="integer", description="Número de notificações que foram marcadas como lidas", example=5)
 *         )
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
class MarkAllAsRead
{
    // Esta classe existe apenas para conter a documentação do endpoint
}
