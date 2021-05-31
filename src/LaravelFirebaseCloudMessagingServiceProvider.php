<?php

namespace BaltTechnologies\LaravelFirebaseCloudMessaging;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelFirebaseCloudMessagingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'cloudMessaging');
    }

    public function boot()
    {
        $this->registerRoutes();

        if ($this->app->runningInConsole()) {

            // publish config
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('cloudMessaging.php'),
            ], 'config');

            // publish migration
            if (! class_exists('CreateCloudMessagingTokensTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_cloud_messaging_tokens_table.php.stub' => database_path('migrations/' . date('Y_m_d_His') . '_create_cloud_messaging_tokens_table.php'),
                ], 'migrations');
            }

            // publish default service
            $this->publishes([
                __DIR__.'/../Soervices/CloudMessagingService.php' => app_path(config('cloudMessaging.servicesPathFromRoot')),
            ], 'example-service');

            // publish example de/en translations
            $this->publishes([
                __DIR__.'/../src/resources/lang' => resource_path('lang'),
            ], 'example-translations');

            // publish example listener
            $this->publishes([
                __DIR__.'/../src/Listeners/ExamplePushNotification.php' => app_path('Listeners'),
            ], 'example-translations');

        }
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/cloudMessaging.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('cloudMessaging.prefix'),
            'middleware' => config('cloudMessaging.middleware'),
        ];
    }
}