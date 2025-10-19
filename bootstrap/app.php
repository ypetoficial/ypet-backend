<?php

use App\Common\ExceptionMessageMapper;
use App\Http\Middleware\EnsureClientTypeHeader;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'client.type' => EnsureClientTypeHeader::class,
        ]);

        $middleware->api(append: [
            EnsureClientTypeHeader::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Throwable $e, $request) {
            if (!$request->expectsJson() && !$request->is('api/*')) {
                return null;
            }

            if (app()->environment('production')) {
                Log::error('Exception caught', [
                    'exception' => get_class($e),
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }

            $mapped = ExceptionMessageMapper::map($e);

            $response = [
                'type' => 'error',
                'status' => $mapped['status'],
                'message' => $mapped['message'],
                'show' => $mapped['show'] ?? true,
            ];

            if (isset($mapped['errors'])) {
                $response['errors'] = $mapped['errors'];
            }

            if (app()->environment('local', 'development')) {
                $response['debug'] = [
                    'exception' => get_class($e),
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ];
            }

            return response()->json($response, $mapped['status']);
        });
    })->create();
