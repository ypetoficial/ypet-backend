<?php

namespace App\Docs\Auth\Me;

/**
 * @OA\Post(
 *     path="/api/auth/me/firebase-token",
 *     summary="Atualiza o token Firebase do usuário autenticado",
 *     tags={"Auth"},
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
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"token"},
 *
 *             @OA\Property(property="token", type="string", maxLength=500, example="eGpXAI4TQfOvhpKd04-HnM:APA91bEBArLrI5gONgqaVeU1mUqCUdVOiSoEMcBNaEBGllVOSLEAHGzxTTDjHI-uu", description="Token Firebase FCM para push notifications")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Token Firebase atualizado com sucesso"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Não autenticado"
 *     )
 * )
 */
class MeFirebaseTokenDocumentation {}
