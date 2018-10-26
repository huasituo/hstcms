<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
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
        $appid = $request->headers->get('appid') ? $request->headers->get('appid') : $request->get('appid');
        if(!$appid) {
            return $this->message('Appid does not exist', '-1');
        }
        $apps = hst_api_app();
        if(!isset($apps[$appid]) || !$apps[$appid]) {
            return $this->message('Appid does not exist', '-2');
        }
        $app = $apps[$appid];
        if($app && $app['status']) {
            return $this->message('Appid A suspension of use', '-3');
        }
        if(config('hstcms.apiSign')) {
            $sign = $request->get('sign');
            if(!$sign) {
                return $this->message('Sign Error', '-4');
            }
            $all = $request->all();
            $checkSign = false;
            $HstcmsSign = new HstcmsSign();
            $checkSign = $HstcmsSign->verifySign($all, $app['secret']);
            if(!$checkSign) {
                return $this->message('Sign Error', '-5');
            }
        }
        $request->attributes->add(['apiAppInfo'=>$app]);    //添加参数
        return $next($request);
    }
}
