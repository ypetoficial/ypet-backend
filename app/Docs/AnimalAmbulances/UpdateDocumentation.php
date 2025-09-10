<?php

namespace App\Docs\AnimalAmbulances;

/**
 * @OA\Put(
 *     path="/api/animal-ambulances/{id}",
 *     summary="Atualiza os dados de uma ambulância de animal",
 *     tags={"Animal Ambulances"},
 *
 *     @OA\Parameter(name="id", in="path", required=true, description="ID da ambulância", @OA\Schema(type="integer", example=1)),
 *     @OA\Parameter(name="Authorization", in="header", required=true, description="Token JWT", @OA\Schema(type="string", example="Bearer eyJ...")),
 *     @OA\Parameter(name="X-Client-Type", in="header", required=true, description="Tipo do cliente", @OA\Schema(type="string", example="web")),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="status", type="string", enum={"open", "designated", "in_attendance", "completed"}, example="designated")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ambulância atualizada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="status", type="string", example="designated")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class UpdateDocumentation {}
