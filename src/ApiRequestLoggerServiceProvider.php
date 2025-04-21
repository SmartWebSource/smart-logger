<?php

namespace Smartwebsource\ApiRequestLogger;

use Illuminate\Support\ServiceProvider;
use Smartwebsource\ApiRequestLogger\Middleware\LogApiRequests;
use Illuminate\Routing\Router;

class ApiRequestLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'api_request_logs');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Publish config
        $this->publishes([
            __DIR__ . '/../config/api_request_logs.php' => config_path('api_request_logs.php'),
        ], 'config');

        // Publish views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/api_request_logs'),
        ], 'views');

        // Push middleware only to the API group
        $router = $this->app->make(Router::class);
        $router->pushMiddlewareToGroup('api', LogApiRequests::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/api_request_logs.php',
            'api_request_logs'
        );
    }
}
