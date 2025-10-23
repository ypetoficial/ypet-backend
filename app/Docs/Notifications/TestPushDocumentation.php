<?php

namespace App\Docs\Notifications;

/**
 * @OA\Post(
 *     path="/api/notifications/test-push",
 *     summary="Envia uma notificação push de teste",
 *     tags={"Notifications"},
 *
 *     @OA\Parameter(
 *         name="X-Client-Type",
 *         in="header",
 *         required=true,
 *         description="Client type (e.g., web, mobile)",
 *
 *         @OA\Schema(type="string", example="mobile")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Notificação de teste enviada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Notificação de teste enviada"),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="notification_id", type="integer", example=123),
 *                 @OA\Property(property="push_sent", type="boolean", example=true),
 *                 @OA\Property(property="has_token", type="boolean", example=true)
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Usuário não possui Firebase token configurado",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Usuário não possui Firebase token configurado"),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="has_token", type="boolean", example=false)
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Não autenticado"
 *     )
 * )
 */
class TestPushDocumentation {}
