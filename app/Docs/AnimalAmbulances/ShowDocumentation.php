<?php

namespace App\Docs\AnimalAmbulances;

/**
 * @OA\Get(
 *     path="/api/animal-ambulances/{id}",
 *     summary="Exibe os detalhes de uma ambulância de animal",
 *     tags={"Animal Ambulances"},
 *
 *     @OA\Parameter(name="id", in="path", required=true, description="ID da ambulância", @OA\Schema(type="integer", example=1)),
 *     @OA\Parameter(name="Authorization", in="header", required=true, description="Token JWT", @OA\Schema(type="string", example="Bearer eyJ...")),
 *     @OA\Parameter(name="X-Client-Type", in="header", required=true, description="Tipo do cliente", @OA\Schema(type="string", example="web")),
 *     @OA\Parameter(name="with[]", in="query", required=false, description="Relações. Ex: user, address", @OA\Schema(type="string", example="user,address")),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ambulância encontrada",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="user_id", type="integer", example=1),
 *                 @OA\Property(property="priority", type="string", example="high"),
 *                 @OA\Property(property="status", type="string", example="open"),
 *                 @OA\Property(property="evidence_path", type="string", example="/storage/evidence/animal_ambulance_1.jpg"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-15T10:30:00Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-15T10:30:00Z")
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class ShowDocumentation {}
