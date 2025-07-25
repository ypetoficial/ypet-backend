<?php

namespace App\Docs\Animals;

/**
 * @OA\Get(
 *     path="/api/animals",
 *     summary="Lista todos os animais (com ou sem paginação)",
 *     tags={"Animals"},
 *
 *     @OA\Parameter(
 *         name="Authorization",
 *         in="header",
 *         required=true,
 *         description="Token JWT. Exemplo: Bearer {token}",
 *
 *         @OA\Schema(type="string", example="Bearer eyJ...token...")
 *     ),
 *
 *     @OA\Parameter(
 *         name="X-Client-Type",
 *         in="header",
 *         required=true,
 *         description="Client type (e.g., web, mobile)",
 *
 *         @OA\Schema(type="string", example="web")
 *     ),
 *
 *     @OA\Parameter(
 *         name="with[]",
 *         in="query",
 *         required=false,
 *         description="Relações a serem carregadas. Ex: status, historyAnimalStatus",
 *
 *         @OA\Schema(type="string", example="status")
 *     ),
 *
 *     @OA\Parameter(
 *         name="without_pagination",
 *         in="query",
 *         required=false,
 *         description="Se true, desativa a paginação",
 *
 *         @OA\Schema(type="boolean", example=false)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Lista de animais retornada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="current_page", type="integer", example=1),
 *                 @OA\Property(property="data", type="array",
 *
 *                     @OA\Items(
 *
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="name", type="string", example="Buddy"),
 *                         @OA\Property(property="species", type="string", example="dog"),
 *                         @OA\Property(property="status", type="string", example="for_adoption")
 *                     )
 *                 ),
 *                 @OA\Property(property="total", type="integer", example=1)
 *             ),
 *             @OA\Property(property="show", type="boolean", example=false)
 *         )
 *     )
 * )
 */
class IndexDocumentation {}
