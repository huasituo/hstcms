<?php 

namespace Huasituo\Hstcms\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Huasituo\Hstcms\Libraries\HstcmsSign;
use Huasituo\Hstcms\Helpers\Api\ApiResponse;

class ApiService
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $appid = $request->get('appid');
        if(!$appid) {
            return $this->message('Appid does not exist', 'error');
        }
        $apps = hst_api_app();
        if(!isset($apps[$appid])) {
            return $this->message('Appid does not exist', 'error');
        }
        $app = $apps[$appid];
        if($app && $app['status']) {
            return $this->message('Appid A suspension of use', 'error');
        }
        if(config('hstcms.apiSign')) {
            $sign = $request->get('sign');
            if(!$sign) {
                return $this->message('Sign Error', 'error');
            }
            $all = $request->all();
            $checkSign = false;
            $HstcmsSign = new HstcmsSign();
            $checkSign = $HstcmsSign->verifySign($all, $app['secret']);
            if(!$checkSign) {
                return $this->message('Sign Error', 'error');
            }
        }
        $request->attributes->add(['apiAppInfo'=>$app]);    //添加参数
        return $next($request);
    }
}
