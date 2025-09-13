<?php

namespace App\Docs\AdoptionVisit;

/**
 * @OA\Post(
 *     path="/adoption-visits/{uuid}/cancel",
 *     summary="Cancelar visita de adoção",
 *     description="Cancela uma visita de adoção agendada",
 *     tags={"Adoption Visit"},
 *
 *     @OA\Parameter(
 *         name="uuid",
 *         in="path",
 *         required=true,
 *         description="UUID da visita de adoção",
 *
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Visita cancelada com sucesso",
 *
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Visita cancelada com sucesso"
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Visita não encontrada",
 *
 *         @OA\JsonContent(
 *             example={
 *                 "success": false,
 *                 "message": "Visita não encontrada"
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação ou visita já cancelada",
 *
 *         @OA\JsonContent(
 *             example={
 *                 "success": false,
 *                 "message": "Não é possível cancelar esta visita"
 *             }
 *         )
 *     )
 * )
 */
