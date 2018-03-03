<?php 

namespace Huasituo\Hstcms\Providers;

use Illuminate\Support\ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('manage.request.log', function ($app) {
            return new \Huasituo\Hstcms\Http\Middleware\RequestLog($app['hstcms']);
        });
        $this->app->singleton('manage.auth.check', function ($app) {
            return new \Huasituo\Hstcms\Http\Middleware\CheckAuth($app['hstcms']);
        });
        $this->app->singleton('api.service', function ($app) {
            return new \Huasituo\Hstcms\Http\Middleware\ApiService($app['hstcms']);
        });
    }
}