<?php

namespace Smartwebsource\RequestLogger;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Smartwebsource\RequestLogger\Middleware\LogRequests;

class RequestLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (!config('request_logs.capture')) {
            return true;
        }
        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'request_logs');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if ($this->app->runningInConsole()) {
            // Publish config
            $this->publishes([
                __DIR__ . '/../config/request_logs.php' => config_path('request_logs.php'),
            ], 'config');

            // Publish views
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/request_logs'),
            ], 'views');
        }


        $router = $this->app->make(\Illuminate\Routing\Router::class);
        $router->pushMiddlewareToGroup('web', LogRequests::class);
        $router->pushMiddlewareToGroup('api', LogRequests::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/request_logs.php',
            'request_logs'
        );
    }
}
