<?php

namespace App\Docs\Notifications;

/**
 * @OA\Schema(
 *     schema="Notification",
 *     type="object",
 *     title="Notificação",
 *     description="Estrutura de uma notificação do sistema",
 *
 *     @OA\Property(property="id", type="integer", description="ID único da notificação", example=1),
 *     @OA\Property(property="title", type="string", description="Título da notificação", example="Lembrete de Castração"),
 *     @OA\Property(property="message", type="string", description="Mensagem da notificação", example="O agendamento de Thor para castração é amanhã às 09:00."),
 *     @OA\Property(property="type", type="string", enum={"alerta", "lembrete", "confirmacao", "informativa"}, description="Tipo da notificação", example="lembrete"),
 *     @OA\Property(property="datetime", type="string", format="date-time", description="Data e hora de criação", example="2025-10-23T09:00:00Z"),
 *     @OA\Property(property="status", type="string", enum={"lida", "não lida"}, description="Status de leitura", example="não lida"),
 *     @OA\Property(property="action_label", type="string", nullable=true, description="Texto do botão de ação", example="Ver agendamento"),
 *     @OA\Property(property="action_target", type="string", nullable=true, description="Destino da ação", example="/agendamentos/123")
 * )
 *
 * @OA\Schema(
 *     schema="NotificationList",
 *     type="object",
 *     title="Lista de Notificações",
 *     description="Resposta da listagem de notificações com paginação",
 *
 *     @OA\Property(property="success", type="boolean", description="Status da operação", example=true),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         description="Array de notificações",
 *
 *         @OA\Items(ref="#/components/schemas/Notification")
 *     ),
 *
 *     @OA\Property(
 *         property="pagination",
 *         type="object",
 *         description="Informações de paginação",
 *         @OA\Property(property="current_page", type="integer", example=1),
 *         @OA\Property(property="total", type="integer", example=25),
 *         @OA\Property(property="per_page", type="integer", example=20),
 *         @OA\Property(property="last_page", type="integer", example=2),
 *         @OA\Property(property="from", type="integer", example=1),
 *         @OA\Property(property="to", type="integer", example=20)
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="UnreadCount",
 *     type="object",
 *     title="Contagem de Não Lidas",
 *     description="Resposta da contagem de notificações não lidas",
 *
 *     @OA\Property(property="success", type="boolean", description="Status da operação", example=true),
 *     @OA\Property(property="count", type="integer", description="Número de notificações não lidas", example=5)
 * )
 *
 * @OA\Schema(
 *     schema="NotificationSuccessResponse",
 *     type="object",
 *     title="Resposta de Sucesso - Notificação",
 *     description="Resposta padrão de sucesso para operações de notificação",
 *
 *     @OA\Property(property="success", type="boolean", description="Status da operação", example=true),
 *     @OA\Property(property="message", type="string", description="Mensagem de sucesso", example="Notificação marcada como lida")
 * )
 *
 * @OA\Schema(
 *     schema="NotificationErrorResponse",
 *     type="object",
 *     title="Resposta de Erro - Notificação",
 *     description="Resposta padrão de erro para operações de notificação",
 *
 *     @OA\Property(property="success", type="boolean", description="Status da operação", example=false),
 *     @OA\Property(property="message", type="string", description="Mensagem de erro", example="Notificação não encontrada"),
 *     @OA\Property(property="error", type="string", nullable=true, description="Detalhes do erro (apenas em debug)", example=null)
 * )
 */
class NotificationSchemas
{
    // Esta classe existe apenas para conter as definições de schema do Swagger
}
