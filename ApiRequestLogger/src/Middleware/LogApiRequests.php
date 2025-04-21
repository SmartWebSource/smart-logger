<?php

namespace Smartwebsource\ApiRequestLogger\Middleware;

use Closure;
use Illuminate\Http\Request;
use Smartwebsource\ApiRequestLogger\Models\ApiRequestLog;

class LogApiRequests
{
    public function handle(Request $request, Closure $next)
    {
        if (config('api_request_logs.capture')) {
            ApiRequestLog::create([
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'headers' => $request->headers->all(),
                'body' => $request->all(),
            ]);
        }

        return $next($request);
    }
}
