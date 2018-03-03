<?php 

namespace Huasituo\Hstcms\Http\Controllers\Api;

use Huasituo\Hstcms\Http\Controllers\Api\BasicController as ApiBaseController;

use Illuminate\Http\Request;

class TestController extends ApiBaseController
{

    public function index() 
    {
        return $this->message('测试成功');
    }
}