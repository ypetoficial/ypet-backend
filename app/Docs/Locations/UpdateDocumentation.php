<?php

namespace App\Docs\Locations;

/**
 * @OA\Put(
 *     path="/locations/{uuid}",
 *     summary="Atualiza uma localização existente",
 *     description="Atualiza os dados de uma localização com base no UUID informado.",
 *     tags={"Locations"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="uuid",
 *         in="path",
 *         required=true,
 *         description="UUID da localização a ser atualizada",
 *
 *         @OA\Schema(type="string", example="a3f4c9b2-1234-5678-9abc-9876543210ff")
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="location_name", type="string", example="Centro de Adoção São Francisco"),
 *             @OA\Property(property="location_type", type="string", example="SHELTER", description="Enum de tipos de local (ver LocationTypeEnum)"),
 *             @OA\Property(property="responsible_name", type="string", example="João da Silva"),
 *             @OA\Property(property="phone", type="integer", example=33999887766),
 *             @OA\Property(property="email", type="string", example="contato@centroadocao.com"),
 *             @OA\Property(
 *                 property="address",
 *                 type="array",
 *
 *                 @OA\Items(
 *
 *                     @OA\Property(property="zipcode", type="string", example="35000-000"),
 *                     @OA\Property(property="street", type="string", example="Rua das Flores"),
 *                     @OA\Property(property="number", type="string", example="123"),
 *                     @OA\Property(property="complement", type="string", example="Sala 4"),
 *                     @OA\Property(property="neighborhood", type="string", example="Centro"),
 *                     @OA\Property(property="city", type="string", example="Governador Valadares"),
 *                     @OA\Property(property="state", type="string", example="MG")
 *                 )
 *             ),
 *             @OA\Property(property="cnpj", type="string", example="12.345.678/0001-99"),
 *             @OA\Property(property="bank_account_or_pix", type="string", example="contato@pix.com"),
 *             @OA\Property(property="status", type="string", example="ACTIVE", description="Enum de status (ACTIVE ou INACTIVE)"),
 *             @OA\Property(property="notes", type="string", example="Local parceiro da prefeitura.")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Operação realizada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="message", type="string", example="Operação realizada com sucesso"),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Localização não encontrada",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="error"),
 *             @OA\Property(property="status", type="integer", example=404),
 *             @OA\Property(property="message", type="string", example="Localização não encontrada"),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação nos campos enviados",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="error"),
 *             @OA\Property(property="status", type="integer", example=422),
 *             @OA\Property(property="message", type="string", example="Os dados fornecidos são inválidos."),
 *             @OA\Property(property="show", type="boolean", example=true),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 example={
 *                     "email": {"O campo email já está em uso."},
 *                     "status": {"O valor selecionado para status é inválido."}
 *                 }
 *             )
 *         )
 *     )
 * )
 */
class UpdateDocumentation {}
