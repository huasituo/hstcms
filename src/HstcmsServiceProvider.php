<?php 

namespace Huasituo\Hstcms;

use Huasituo\Hstcms\Contracts\Repository;
use Huasituo\Hstcms\Providers\RouteServiceProvider;
use Huasituo\Hstcms\Providers\HelperServiceProvider;
use Huasituo\Hstcms\Providers\ConsoleServiceProvider;
use Huasituo\Hstcms\Providers\LibrariesServiceProvider;
use Huasituo\Hstcms\Providers\RepositoryServiceProvider;
use Huasituo\Hstcms\Providers\MiddlewareServiceProvider;
use Huasituo\Hstcms\Providers\GeneratorServiceProvider;

use Illuminate\Support\ServiceProvider;

class HstcmsServiceProvider extends ServiceProvider
{ 
    /**
     * @var bool Indicates if loading of the provider is deferred.
     */
    protected $defer = false;

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/hstcms.php' => config_path('hstcms.php'),
        ], 'config');
        $this->loadViewsFrom(__DIR__.'/../views', 'hstcms');
        // $this->publishes([
        //     __DIR__.'/../views'=>base_path('resources/views/vendor/hstcms'),
        // ]);
        $this->publishes([
            __DIR__.'/../assets' => public_path('assets'),
        ], 'public');
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__.'/../translations', 'hstcms');
        // $this->publishes([
        //     __DIR__.'/../translations' => resource_path('lang/vendor/hstcms'),
        // ]);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/hstcms.php', 'hstcms'
        );

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(HelperServiceProvider::class);
        $this->app->register(ConsoleServiceProvider::class);
        $this->app->register(LibrariesServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(MiddlewareServiceProvider::class);
        $this->app->register(GeneratorServiceProvider::class);

        $this->app->singleton('hstcms', function ($app) {
            $repository = $app->make(Repository::class);
            return new Hstcms($app, $repository);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string
     */
    public function provides()
    {
        return ['hstcms'];
    }
}