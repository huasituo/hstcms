<?php 

namespace Huasituo\Hstcms\Providers;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
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
        $this->registerInstallCommand();
        $this->registerInfoCommand();
        $this->registerSeedCommand();
        $this->registerCacheCommand();
    }

    /**
     * Register the hstcms.install command.
     */
    protected function registerInstallCommand()
    {
        $this->app->singleton('command.hstcms.install', function ($app) {
            return new \Huasituo\Hstcms\Console\Commands\HstcmsInstallCommand($app['hstcms']);
        });
        $this->commands('command.hstcms.install');
    }

    /**
     * Register the hstcms.info command.
     */
    protected function registerInfoCommand()
    {
        $this->app->singleton('command.hstcms.info', function ($app) {
            return new \Huasituo\Hstcms\Console\Commands\HstcmsInfoCommand($app['hstcms']);
        });
        $this->commands('command.hstcms.info');
    }

    /**
     * Register the module:seed command.
     */
    protected function registerSeedCommand()
    {
        $this->app->singleton('command.hstcms.seed', function ($app) {
            return new \Huasituo\Hstcms\Console\Commands\HstcmsSeedCommand($app['hstcms']);
        });
        $this->commands('command.hstcms.seed');
    }

    /**
     * Register the module:cache command.
     */
    protected function registerCacheCommand()
    {
        $this->app->singleton('command.hstcms.cache', function ($app) {
            return new \Huasituo\Hstcms\Console\Commands\HstcmsCacheCommand($app['hstcms']);
        });
        $this->commands('command.hstcms.cache');
    }
}
