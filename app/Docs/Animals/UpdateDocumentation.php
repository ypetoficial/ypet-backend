<?php

namespace App\Docs\Animals;

/**
 * @OA\Put(
 *     path="/api/animals/{id}",
 *     summary="Atualiza os dados de um animal",
 *     tags={"Animals"},
 *
 *     @OA\Parameter(name="id", in="path", required=true, description="ID do animal", @OA\Schema(type="integer", example=1)),
 *     @OA\Parameter(name="Authorization", in="header", required=true, description="Token JWT", @OA\Schema(type="string", example="Bearer eyJ...")),
 *     @OA\Parameter(name="X-Client-Type", in="header", required=true, description="Tipo do cliente", @OA\Schema(type="string", example="web")),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *              @OA\Property(property="name", type="string", example="Buddy"),
 *              @OA\Property(property="species", type="string", example="dog"),
 *              @OA\Property(property="status", type="string", example="for_adoption"),
 *              @OA\Property(property="gender", type="string", example="male"),
 *              @OA\Property(property="weight", type="number", example=12.5),
 *              @OA\Property(property="birth_date", type="string", format="date", example="2020-05-10"),
 *              @OA\Property(property="color", type="string", example="brown"),
 *              @OA\Property(property="castrated", type="boolean", example=true),
 *              @OA\Property(property="tutor_id", type="integer", example=3),
 *              @OA\Property(property="size", type="string", example="small"),
 *              @OA\Property(property="coat", type="string", example="short"),
 *              @OA\Property(property="characteristics", type="string", example="Friendly and playful"),
 *              @OA\Property(property="surname", type="string", example="Smith"),
 *              @OA\Property(property="picture", type="string", format="binary", example="base64EncodedImageString"),
 *              @OA\Property(property="microchip_number", type="number", example=123456789),
 *              @OA\Property(property="registration_number", type="number", example=987654321),
 *              @OA\Property(property="dewormed", type="boolean", example=true),
 *              @OA\Property(property="infirmity", type="string", example="None"),
 *              @OA\Property(property="entry_date", type="string", format="date", example="2023-01-15"),
 *              @OA\Property(property="castration_site", type="string", example="Local Vet Clinic"),
 *              @OA\Property(property="collection_site", type="string", example="Downtown Shelter"),
 *              @OA\Property(property="collection_reason", type="string", example="Stray"),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Animal atualizado com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Buddy")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class UpdateDocumentation {}
