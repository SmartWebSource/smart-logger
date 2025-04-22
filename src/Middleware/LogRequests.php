<?php

namespace Smartwebsource\RequestLogger\Middleware;

use Closure;
use Illuminate\Http\Request;
use Smartwebsource\RequestLogger\Models\RequestLog;

class LogRequests
{
    public function handle(Request $request, Closure $next)
    {
        if (
            !str_contains($request->path(), 'log') &&
            !str_contains($request->path(), 'adminer') &&
            !str_contains($request->path(), 'status/jobs') &&
            !str_contains($request->path(), 'auth') &&
            !$request->is('telescope*') &&
            !$request->is('nova*') &&
            !$request->is('horizon*') &&
            !$request->is('assets/*') &&
            !$request->is('app-assets/*') &&
            !$request->is('css/*') &&
            !$request->is('js/*') &&
            !$request->is('uploads/*')
        ) {
            $isWeb = !$request->expectsJson();
            $captureApi = config('request_logs.capture_web');
            $captureWeb = config('request_logs.capture_web');

            $method = strtoupper($request->method());
            $allowedApiMethods = array_map('trim', explode(',', strtoupper(config('request_logs.api_request_method'))));
            $allowedWebMethods = array_map('trim', explode(',', strtoupper(config('request_logs.web_request_method'))));

            $shouldCapture = (!$isWeb && $captureApi && in_array($method, $allowedApiMethods)) ||
                ($isWeb && $captureWeb && in_array($method, $allowedWebMethods));

            if ($shouldCapture) {
                RequestLog::create([
                    'user_id' => $request->user() ? $request->user()->id : null,
                    'method' => $request->method(),
                    'url' => $request->fullUrl(),
                    'headers' => $request->headers->all(),
                    'body' => $request->all(),
                    'request_type' => $isWeb ? 'web' : 'api',
                ]);
            }
        }
        return $next($request);
    }
}
