<?php

namespace App\Docs\Locations;

/**
 * @OA\Post(
 *     path="/api/location",
 *     summary="Cadastra uma nova localização",
 *     tags={"Locations"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"location_name", "location_type", "responsible_name", "phone", "status"},
 *
 *             @OA\Property(property="location_name", type="string", example="Happy Paws Shelter"),
 *             @OA\Property(property="location_type", type="string", example="pet_hotel", description="Enum de tipos de local (ver LocationTypeEnum)"),
 *             @OA\Property(property="responsible_name", type="string", example="Daniel Andrade"),
 *             @OA\Property(property="phone", type="integer", example=31987654321),
 *             @OA\Property(property="email", type="string", example="contact@happypawssq.com"),
 *             @OA\Property(
 *                 property="address",
 *                 type="array",
 *
 *                 @OA\Items(
 *
 *                     @OA\Property(property="zipcode", type="string", example="35010-600"),
 *                     @OA\Property(property="street", type="string", example="Rua Flores"),
 *                     @OA\Property(property="number", type="string", example="123"),
 *                     @OA\Property(property="complement", type="string", example="Bloco B"),
 *                     @OA\Property(property="neighborhood", type="string", example="Centro"),
 *                     @OA\Property(property="city", type="string", example="Governador Valadares"),
 *                     @OA\Property(property="state", type="string", example="MG")
 *                 )
 *             ),
 *             @OA\Property(property="cnpj", type="string", example="12.345.678/0001-99"),
 *             @OA\Property(property="bank_account_or_pix", type="string", example="contato@pix.com"),
 *             @OA\Property(property="status", type="integer", example=1, description="1 = ativo, 0 = inativo"),
 *             @OA\Property(property="notes", type="string", example="Local especializado em hospedagem e cuidados temporários de animais resgatados.")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Localização cadastrada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="message", type="string", example="Operação realizada com com sucesso"),
 *             @OA\Property(property="show", type="boolean", example=true),
 *             @OA\Property(
 *                 property="response",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=2),
 *                 @OA\Property(property="uuid", type="string", example="3ab7d7ef-4582-4c5a-8f50-74a6f1ab1fbd"),
 *                 @OA\Property(property="location_name", type="string", example="Happy Paws Shelter"),
 *                 @OA\Property(property="location_type", type="string", example="pet_hotel"),
 *                 @OA\Property(property="responsible_name", type="string", example="Daniel Andrade"),
 *                 @OA\Property(property="email", type="string", example="contact@happypawssq.com"),
 *                 @OA\Property(property="phone", type="string", example="31987654321"),
 *                 @OA\Property(property="status", type="integer", example=1),
 *                 @OA\Property(property="notes", type="string", example="Local especializado em hospedagem e cuidados temporários de animais resgatados."),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-16T17:06:42.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-16T17:06:42.000000Z")
 *             )
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
 *                     "location_name": {"O campo location_name é obrigatório."},
 *                     "status": {"O valor selecionado para status é inválido."}
 *                 }
 *             )
 *         )
 *     )
 * )
 */
class StoreDocumentation {}
