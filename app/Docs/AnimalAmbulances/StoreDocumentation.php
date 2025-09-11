<?php

namespace App\Docs\AnimalAmbulances;

/**
 * @OA\Post(
 *     path="/api/animal-ambulances",
 *     summary="Cadastra uma nova ambulância de animal",
 *     tags={"Animal Ambulances"},
 *
 *     @OA\Parameter(name="Authorization", in="header", required=true, description="Token JWT", @OA\Schema(type="string", example="Bearer eyJ...")),
 *     @OA\Parameter(name="X-Client-Type", in="header", required=true, description="Tipo do cliente", @OA\Schema(type="string", example="web")),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *
 *             @OA\Schema(
 *                 required={"reason_id", "evidence", "latitude", "longitude"},
 *
 *                 @OA\Property(property="reason_id", type="integer", example=1, description="ID da razão da ambulância"),
 *                 @OA\Property(property="evidence", type="string", format="binary", description="Arquivo de evidência (imagem)"),
 *                 @OA\Property(property="latitude", type="number", format="float", example=-23.5505, description="Latitude da localização"),
 *                 @OA\Property(property="longitude", type="number", format="float", example=-46.6333, description="Longitude da localização")
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Ambulância cadastrada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=201),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="response", type="object",
 *                     @OA\Property(property="id", type="integer", example=5),
 *                     @OA\Property(property="user_id", type="integer", example=1),
 *                     @OA\Property(property="priority", type="string", example="high"),
 *                     @OA\Property(property="status", type="string", example="open")
 *                 )
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class StoreDocumentation {}
