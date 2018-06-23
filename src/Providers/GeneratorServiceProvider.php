<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
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
            'command.make.hstcms.manage.founder'    => \Huasituo\Hstcms\Console\Generators\MakeManageFounderCommand::class,
            'command.make.hstcms.api'               => \Huasituo\Hstcms\Console\Generators\MakeApiCommand::class,
        ];

        foreach ($generators as $slug => $class) {
            $this->app->singleton($slug, function ($app) use ($slug, $class) {
                return $app[$class];
            });
            $this->commands($slug);
        }
    }
}
