<?php
// Arquivo para servir a documentação Swagger JSON gerada pelo swagger-php
require_once __DIR__ . '/../vendor/autoload.php';

use OpenApi\Generator;

header('Content-Type: application/json');

echo Generator::scan([
    realpath(__DIR__ . '/../app'),
    realpath(__DIR__ . '/../routes'),
])->toJson();
