<?php

namespace App\Docs\Animals;

/**
 * @OA\Post(
 *     path="/api/animals",
 *     summary="Cadastra um novo animal",
 *     tags={"Animals"},
 *
 *     @OA\Parameter(name="Authorization", in="header", required=true, description="Token JWT", @OA\Schema(type="string", example="Bearer eyJ...")),
 *     @OA\Parameter(name="X-Client-Type", in="header", required=true, description="Tipo do cliente", @OA\Schema(type="string", example="web")),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"name", "species", "status"},
 *
 *             @OA\Property(property="name", type="string", example="Buddy"),
 *             @OA\Property(property="species", type="string", example="dog"),
 *             @OA\Property(property="status", type="string", example="for_adoption"),
 *             @OA\Property(property="gender", type="string", example="male"),
 *             @OA\Property(property="weight", type="number", example=12.5),
 *             @OA\Property(property="birth_date", type="string", format="date", example="2020-05-10"),
 *             @OA\Property(property="color", type="string", example="brown"),
 *             @OA\Property(property="castrated", type="boolean", example=true)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Animal cadastrado com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=201),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=5),
 *                 @OA\Property(property="name", type="string", example="Buddy")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class StoreDocumentation {}
