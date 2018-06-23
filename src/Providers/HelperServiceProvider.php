<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Providers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $file = $this->app->make(Filesystem::class);
        $path    = realpath(__DIR__.'/../Helpers');
        $helpers = $file->glob($path.'/*.php');
        foreach ($helpers as $helper) 
        {
            require_once($helper);
        }
        $helpers = $file->glob($path.'/*/*.php');
        foreach ($helpers as $helper) 
        {
            require_once($helper);
        }
    }
}
