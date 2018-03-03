<?php 

namespace Huasituo\Hstcms\Providers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class LibrariesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the libraries services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the libraries services.
     *
     * @return void
     */
    public function register()
    {
        $file = $this->app->make(Filesystem::class);
        $path    = realpath(__DIR__.'/../Libraries');
        $libraries = $file->glob($path.'/*.php');
        foreach ($libraries as $librarie) 
        {
            require_once($librarie);
        }
    }
}
