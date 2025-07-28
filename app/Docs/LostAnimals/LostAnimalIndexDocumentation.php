<?php

namespace App\Docs\LostAnimals;

/**
 * @OA\Get(
 *     path="/api/lost-animals",
 *     summary="Lista todos os animais perdidos",
 *     tags={"Lost Animals"},
 *
 *     @OA\Parameter(name="Authorization", in="header", required=true, description="Token JWT", @OA\Schema(type="string", example="Bearer eyJ...")),
 *     @OA\Parameter(name="X-Client-Type", in="header", required=true, description="Tipo do cliente", @OA\Schema(type="string", example="web")),
 *     @OA\Parameter(name="with[]", in="query", required=false, description="Relações. Ex: animal", @OA\Schema(type="string", example="animal")),
 *     @OA\Parameter(name="without_pagination", in="query", required=false, description="Se true, desativa paginação", @OA\Schema(type="boolean", example=false)),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Lista de animais perdidos",
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
 *                         @OA\Property(property="status", type="string", example="pending")
 *                     )
 *                 )
 *             ),
 *             @OA\Property(property="show", type="boolean", example=false)
 *         )
 *     )
 * )
 */
class LostAnimalIndexDocumentation {}
