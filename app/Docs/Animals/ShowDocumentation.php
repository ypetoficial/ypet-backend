<?php

namespace App\Docs\Animals;

/**
 * @OA\Get(
 *     path="/api/animals/{id}",
 *     summary="Exibe os detalhes de um animal",
 *     tags={"Animals"},
 *
 *     @OA\Parameter(name="id", in="path", required=true, description="ID do animal", @OA\Schema(type="integer", example=1)),
 *     @OA\Parameter(name="Authorization", in="header", required=true, description="Token JWT", @OA\Schema(type="string", example="Bearer eyJ...")),
 *     @OA\Parameter(name="X-Client-Type", in="header", required=true, description="Tipo do cliente", @OA\Schema(type="string", example="web")),
 *     @OA\Parameter(name="with[]", in="query", required=false, description="Relações. Ex: status, historyAnimalStatus", @OA\Schema(type="string", example="status")),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Animal encontrado",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Buddy"),
 *                 @OA\Property(property="species", type="string", example="dog")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class ShowDocumentation {}
