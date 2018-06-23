<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
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
        foreach ($libraries as $librarie) {
            require_once($librarie);
        }

        $libraries2 = $file->glob($path.'/HuasituoApi/*.php');
        foreach ($libraries2 as $librarie) {
            require_once($librarie);
        }

        $libraries3 = $file->glob($path.'/HuasituoApi/Request/*.php');
        foreach ($libraries3 as $librarie) {
            require_once($librarie);
        }

        $fields = $file->glob($path.'/Fields/*.php');
        foreach ($fields as $field) {
            require_once($field);
        }

        $alipays = $file->glob($path.'/Alipay/*.php');
        foreach ($alipays as $librarie) {
            require_once($librarie);
        }
    }
}
