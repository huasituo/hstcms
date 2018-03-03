<?php

namespace Huasituo\Hstcms\Providers;

use Illuminate\Support\ServiceProvider;

class GeneratorServiceProvider extends ServiceProvider
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
        $generators = [
            'command.make.hstcms'                   => \Huasituo\Hstcms\Console\Generators\MakeInstallCommand::class,
            'command.make.hstcms.manage.founder'       => \Huasituo\Hstcms\Console\Generators\MakeManageFounderCommand::class,
        ];

        foreach ($generators as $slug => $class) {
            $this->app->singleton($slug, function ($app) use ($slug, $class) {
                return $app[$class];
            });
            $this->commands($slug);
        }
    }
}
