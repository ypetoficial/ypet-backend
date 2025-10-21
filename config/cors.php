<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Configuração completa para permitir:
    | - app.ypet.com.br (produção - Vercel)
    | - localhost:5173 (dev local)
    | - 192.x.x.x (rede local para testes mobile)
    |
    */

    // Caminhos da API que terão CORS ativo
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Permite todos os métodos HTTP (GET, POST, PUT, DELETE, OPTIONS etc.)
    'allowed_methods' => ['*'],

    // Domínios e origens autorizados
    'allowed_origins' => [
        'https://app.ypet.com.br',   // produção (Vercel)
        'http://localhost:5173',     // ambiente local
    ],

    // Padrões para IPs locais (ex: 192.168.0.10:5173)
    'allowed_origins_patterns' => [
        '/^http:\/\/192\.168\.\d+\.\d+(:\d+)?$/',  // qualquer IP local
        '/^http:\/\/10\.\d+\.\d+\.\d+(:\d+)?$/',   // redes 10.x.x.x também
    ],

    // Permite todos os headers enviados pelo front
    'allowed_headers' => ['*'],

    // Headers que podem ser expostos na resposta
    'exposed_headers' => [],

    // Tempo de cache da verificação (em segundos)
    'max_age' => 0,

    // Permite cookies, tokens e sessões (Sanctum)
    'supports_credentials' => true,

];
