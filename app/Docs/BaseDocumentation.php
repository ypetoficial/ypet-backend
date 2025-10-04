<?php

namespace App\Docs;

/**
 * @OA\OpenApi(
 *
 *     @OA\Info(
 *         title="YPet API",
 *         version="1.0.0",
 *         description="Documentação da API do sistema YPet"
 *     ),
 *
 *     @OA\Tag(name="Auth", description="Autenticação e gerenciamento de sessão"),
 *     @OA\Tag(name="Enums", description="Consulta de enums disponíveis"),
 *     @OA\Tag(name="Users", description="Gerenciamento de usuários"),
 *     @OA\Tag(name="Animals", description="Cadastro e controle de animais"),
 *     @OA\Tag(name="Citizens", description="Gerenciamento de cidadãos"),
 *     @OA\Tag(name="AdoptionVisit", description="Gerenciamento de cidadãos"),
 *     @OA\Tag(name="Protectors", description="Gerenciamento de protetores"),
 *     @OA\Tag(name="PanelConfig", description="Configuração do Painel"),
 *     @OA\Tag(name="PreSurgeryAssessment", description="Triagem do animal para castração"),
 *
 *      @OA\Server(
 *      url="{scheme}://{host}:{port}",
 *       description="Servidor dinâmico",
 *       variables={
 *
 *           @OA\ServerVariable(
 *               serverVariable="scheme",
 *               enum={"http", "https"},
 *               default="http"
 *           ),
 *           @OA\ServerVariable(
 *               serverVariable="host",
 *               default="localhost"
 *           ),
 *           @OA\ServerVariable(
 *               serverVariable="port",
 *               enum={"8000", "443", "80"},
 *               default="8000"
 *           )
 *       }
 *  )
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class BaseDocumentation {}
