<?php

namespace App\Docs\PreSurgeryAssessment;

/**
 * @OA\Post(
 *     path="/api/pre-surgery-assessment",
 *     summary="Cadastra uma nova avaliação pré-cirúrgica",
 *     tags={"PreSurgeryAssessment"},
 *
 *     @OA\Parameter(name="Authorization", in="header", required=true, description="Token JWT", @OA\Schema(type="string", example="Bearer eyJ...")),
 *     @OA\Parameter(name="X-Client-Type", in="header", required=true, description="Tipo do cliente", @OA\Schema(type="string", example="web")),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"animal_id", "mucosa", "hydration", "adequate_fasting", "escore_corporal", "heart_rate", "respiratory_rate", "abdominal_palpation", "palpation_of_lymph_nodes", "vulvar_discharge", "foreskin_discharge", "ectopic_testicle"},
 *
 *             @OA\Property(property="animal_id", type="integer", example=1, description="ID do animal"),
 *             @OA\Property(property="mucosa", type="string", example="pink", description="Mucosa (pink, pale, cyanotic, jaundice)"),
 *             @OA\Property(property="hydration", type="string", example="hydrated", description="Hidratação (hydrated, dehydrated)"),
 *             @OA\Property(property="adequate_fasting", type="boolean", example=true, description="Jejum adequado"),
 *             @OA\Property(property="fasting_time", type="integer", example=8, description="Tempo de jejum em horas", nullable=true),
 *             @OA\Property(property="escore_corporal", type="integer", example=3, description="Escore corporal"),
 *             @OA\Property(property="heart_rate", type="integer", example=90, description="Frequência cardíaca"),
 *             @OA\Property(property="respiratory_rate", type="integer", example=25, description="Frequência respiratória"),
 *             @OA\Property(property="abdominal_palpation", type="string", example="normal", description="Palpação abdominal (normal, altered)"),
 *             @OA\Property(property="abdominal_palpation_description", type="string", example=null, description="Descrição da palpação abdominal", nullable=true),
 *             @OA\Property(property="palpation_of_lymph_nodes", type="string", example="normal", description="Palpação de linfonodos (normal, enlarged)"),
 *             @OA\Property(property="palpation_of_lymph_nodes_description", type="string", example=null, description="Descrição da palpação de linfonodos", nullable=true),
 *             @OA\Property(property="vulvar_discharge", type="boolean", example=false, description="Secreção vulvar"),
 *             @OA\Property(property="foreskin_discharge", type="boolean", example=false, description="Secreção prepucial"),
 *             @OA\Property(property="ectopic_testicle", type="boolean", example=false, description="Testículo ectópico"),
 *             @OA\Property(property="obervations", type="string", example="Animal apresentou bom estado geral", description="Observações gerais", nullable=true),
 *             @OA\Property(property="transsurgical_intercurrences", type="string", example=null, description="Intercorrências transcirúrgicas", nullable=true),
 *             @OA\Property(property="measures_taken", type="string", example=null, description="Medidas tomadas", nullable=true),
 *             @OA\Property(
 *                 property="animal_data",
 *                 type="object",
 *                 nullable=true,
 *                 description="Dados do animal (caso não esteja cadastrado)",
 *                 @OA\Property(property="name", type="string", example="Rex", nullable=true),
 *                 @OA\Property(property="species", type="string", example="dog", nullable=true, description="Espécie (dog, cat, all)"),
 *                 @OA\Property(property="gender", type="string", example="male", nullable=true, description="Gênero (male, female, unknown)"),
 *                 @OA\Property(property="weight", type="number", format="float", example=15.5, nullable=true),
 *                 @OA\Property(property="birth_date", type="string", format="date", example="2020-05-15", nullable=true)
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Avaliação pré-cirúrgica cadastrada com sucesso",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="success"),
 *             @OA\Property(property="status", type="integer", example=201),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="response", type="object",
 *                     @OA\Property(property="id", type="integer", example=5),
 *                     @OA\Property(property="animal_id", type="integer", example=1),
 *                     @OA\Property(property="mucosa", type="string", example="pink"),
 *                     @OA\Property(property="hydration", type="string", example="hydrated"),
 *                     @OA\Property(property="adequate_fasting", type="boolean", example=true),
 *                     @OA\Property(property="fasting_time", type="integer", example=8),
 *                     @OA\Property(property="escore_corporal", type="integer", example=3),
 *                     @OA\Property(property="heart_rate", type="integer", example=90),
 *                     @OA\Property(property="respiratory_rate", type="integer", example=25),
 *                     @OA\Property(property="abdominal_palpation", type="string", example="normal"),
 *                     @OA\Property(property="palpation_of_lymph_nodes", type="string", example="normal"),
 *                     @OA\Property(property="vulvar_discharge", type="boolean", example=false),
 *                     @OA\Property(property="foreskin_discharge", type="boolean", example=false),
 *                     @OA\Property(property="ectopic_testicle", type="boolean", example=false)
 *                 )
 *             ),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="type", type="string", example="error"),
 *             @OA\Property(property="status", type="integer", example=422),
 *             @OA\Property(property="message", type="string", example="O animal é obrigatório."),
 *             @OA\Property(property="show", type="boolean", example=true)
 *         )
 *     )
 * )
 */
class StoreDocumentation {}
