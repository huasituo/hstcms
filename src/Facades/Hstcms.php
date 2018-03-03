<?php 

namespace Huasituo\Hstcms\Facades;

use Illuminate\Support\Facades\Facade;

class Hstcms extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'hstcms';
    }
}
