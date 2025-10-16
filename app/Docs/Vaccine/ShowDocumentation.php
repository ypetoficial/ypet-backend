<?php

namespace App\Docs\Vaccine;

/**
 * @OA\Get(
 *     path="/api/vaccine/{uuid}",
 *     summary="Exibe os detalhes de uma vacina",
 *     tags={"Vaccines"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="uuid",
 *         in="path",
 *         required=true,
 *         description="UUID da vacina",
 *
 *         @OA\Schema(type="string", example="cebee980-7772-49f2-b2eb-33b72b09f2b7")
 *     ),
 *
 *     @OA\Parameter(
 *         name="X-Client-Type",
 *         in="header",
 *         required=true,
 *         description="Tipo do cliente",
 *
 *         @OA\Schema(type="string", example="web")
 *     ),
 *
 *     @OA\Parameter(
 *         name="with[]",
 *         in="query",
 *         required=false,
 *         description="Relações para carregar",
 *
 *         @OA\Schema(type="string", example="manufacturer")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Vacina encontrada",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=4),
 *                 @OA\Property(property="uuid", type="string", example="cebee980-7772-49f2-b2eb-33b72b09f2b7"),
 *                 @OA\Property(property="name", type="string", example="Vaccine4"),
 *                 @OA\Property(property="type", type="string", example="Bacterial"),
 *                 @OA\Property(property="status", type="string", example="active"),
 *                 @OA\Property(property="purpose", type="string", example="Ullam quis sed ut laudantium cupiditate neque."),
 *                 @OA\Property(property="alert_at", type="string", format="date-time", example="2025-09-19 10:42:33"),
 *                 @OA\Property(property="alert_sent", type="integer", example=0),
 *                 @OA\Property(property="target_specie", type="string", example="Cat"),
 *                 @OA\Property(property="dose_count", type="integer", example=2),
 *                 @OA\Property(property="dose_interval", type="integer", example=30),
 *                 @OA\Property(property="manu_facturer", type="string", example="Walter LLC"),
 *                 @OA\Property(property="expiration_date", type="string", format="date", example="2025-09-23"),
 *                 @OA\Property(property="batch", type="string", example="VXHBFATEGK"),
 *                 @OA\Property(property="updated_by", type="integer", nullable=true, example=null),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-19T10:39:28.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-19T10:42:33.000000Z")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=false)
 *         )
 *     )
 * )
 */
class ShowDocumentation {}
