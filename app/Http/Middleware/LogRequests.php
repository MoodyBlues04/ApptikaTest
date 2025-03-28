<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequests
{
    public function handle(Request $request, Closure $next)
    {
        Log::channel('requests')->info('request.info', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'data' => $request->all(),
        ]);

        return $next($request);
    }
}
