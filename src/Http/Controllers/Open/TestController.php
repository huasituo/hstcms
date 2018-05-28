<?php 

namespace Huasituo\Hstcms\Http\Controllers\Open;

use App\Modules\Openapi\Http\Controllers\Open\OpenapiBasicController as OpenApiBasicController;

use Illuminate\Http\Request;

class TestController extends OpenApiBasicController
{

    public function index() 
    {
        return $this->notFond();
    }
}