<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Api;

use Huasituo\Hstcms\Http\Controllers\Api\BasicController as ApiBaseController;

use Illuminate\Http\Request;

class TestController extends ApiBaseController
{

    public function index(Request $request) 
    {
    	$apps = hst_api_app();
        return $this->notFond();
    }
}