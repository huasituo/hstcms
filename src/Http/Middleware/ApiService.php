<?php 

namespace Huasituo\Hstcms\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Closure;
use Illuminate\Http\Request;

class ApiService
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $key = $request->get('api_key');
        $apiKey = hst_config('api', 'key');
        if($apiKey) {
            if(!$key) {
                return response()->json(['state'=>'error', 'code'=>'-400', 'message'=>hst_lang('hstcms::api.api.key.empty')]);
            }
            if($key != $apiKey) {
                return response()->json(['state'=>'error', 'code'=>'-401', 'message'=>hst_lang('hstcms::api.api.key.error')]);
            }
        }
        return $next($request);
    }
}
