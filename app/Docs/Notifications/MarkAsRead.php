<?php

namespace App\Docs\Notifications;

/**
 * @OA\Patch(
 *     path="/api/notifications/{id}/read",
 *     summary="Marcar notificação como lida",
 *     description="Marca uma notificação específica como lida. Apenas notificações do usuário autenticado podem ser marcadas.",
 *     operationId="markNotificationAsRead",
 *     tags={"Notifications"},
 *     security={{"bearerAuth": {}}},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID único da notificação",
 *         required=true,
 *
 *         @OA\Schema(type="integer", minimum=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Notificação marcada como lida com sucesso",
 *
 *         @OA\JsonContent(ref="#/components/schemas/NotificationSuccessResponse")
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
 *         response=404,
 *         description="Notificação não encontrada ou não pertence ao usuário",
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
class MarkAsRead
{
    // Esta classe existe apenas para conter a documentação do endpoint
}
