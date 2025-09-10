<?php

namespace App\Http\Middleware;

use App\Domains\Enums\OriginEnum;
use Closure;
use Illuminate\Http\Request;

class EnsureClientTypeHeader
{
    public function handle(Request $request, Closure $next)
    {
        $clientType = $request->header('X-Client-Type');

        if (! $clientType || ! in_array($clientType, OriginEnum::values())) {
            return response()->json([
                'message' => 'Cabeçalho X-Client-Type ausente ou inválido.',
            ], 400);
        }

        return $next($request);
    }
}
