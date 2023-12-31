<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;

// $laravelPath = __DIR__ . '/../no-commit-old/laravel-app';

require_once __DIR__ . '/../utils/laravel-core.php';

function handler(array $event): string
{
    return jsonResponse(
        [
            'app_name' => env('APP_NAME'),
            '__FILE__' => __FILE__ . ':' . __LINE__,
            'php_version' => PHP_VERSION,
            'event' => $event,
        ]
    );
}

function jsonResponse(array|string $body, int $status = 200, bool $bodyIsJson = false): string
{
    $bodyIsJson = is_string($body) && $bodyIsJson;

    $headers = [
        'Content-Type' => 'application/json; charset=utf-8',
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Headers' => 'Content-Type',
        'Access-Control-Allow-Methods' => 'OPTIONS,POST,GET'
    ];

    // Padrão de saída
    return json_encode([
        'statusCode' => $status,
        'headers' => $headers,
        'body' => $bodyIsJson ? json_decode($body) : $body,
    ], 64);
}
