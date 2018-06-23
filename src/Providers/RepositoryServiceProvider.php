<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $namespace = 'Huasituo\Hstcms\Repositories\Repository';
        $this->app->bind('Huasituo\Hstcms\Contracts\Repository', $namespace);
    }
}
