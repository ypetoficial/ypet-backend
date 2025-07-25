<?php

namespace App\Docs\Enums;

/**
 * @OA\Get(
 *     path="/api/enums/{group}",
 *     summary="Lista os valores de um grupo de enums",
 *     tags={"Enums"},
 *
 *     @OA\Parameter(
 *         name="group",
 *         in="path",
 *         required=true,
 *         description="Nome do grupo enum (ex: user_status, animal_status)",
 *
 *         @OA\Schema(type="string", example="user_status")
 *     ),
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
 *         description="Tipo do cliente (ex: web, mobile)",
 *
 *         @OA\Schema(type="string", example="web")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Lista de enums retornada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="array",
 *
 *                 @OA\Items(
 *
 *                     @OA\Property(property="value", type="string", example="active"),
 *                     @OA\Property(property="name", type="string", example="ACTIVE"),
 *                     @OA\Property(property="label", type="string", example="Ativo"),
 *                     @OA\Property(property="color", type="string", example="#000000"),
 *                     @OA\Property(property="description", type="string", example="Usuário ativo")
 *                 )
 *             ),
 *             @OA\Property(property="show", type="boolean", example=false)
 *         )
 *     )
 * )
 */
class EnumGroupDocumentation {}
