<?php 

namespace Huasituo\Hstcms\Http\Middleware;

use Huasituo\Hstcms\Model\ManageUserModel;
use Huasituo\Hstcms\Model\CommonRoleModel;
use Huasituo\Hstcms\Model\ManageLoginLogModel;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Closure;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $manager = $request->session()->get('manager');
        if(!$manager) {
            return redirect()->route('manageAuthLogin');
        }
        $managers = decrypt($manager);
        list($uid, $username, $mobile, $email, $time) = explode('|', $managers);
        $uinfo = ManageUserModel::getUser($uid);
        if(!$uinfo) {
            $request->session()->forget('manager');
            return redirect()->route('manageAuthLogin');
        }
        if($uinfo['status'] == 1) {
            $request->session()->forget('manager');
            ManageLoginLogModel::addLog(hst_manager(), hst_lang('hstcms::manage.user.disable.log'));
            return redirect()->route('manageAuthLogin')->withInput()->withErrors(['password'=> hst_lang('hstcms::manage.user.disable')]);
        }
        $loginCitme = hst_config('safe', 'manage.login.ctime') ? hst_config('safe', 'manage.login.ctime') : 30;
        if(hst_time() - $time > $loginCitme*60) {
            ManageLoginLogModel::addLog(hst_manager(), hst_lang('hstcms::manage.ctime.logout'));
            $request->session()->forget('manager');
            return redirect()->route('manageAuthLogin');
        }
        Session::put('manager', encrypt($uinfo['uid'].'|'.$uinfo['username'].'|'.$uinfo['mobile'].'|'.$uinfo['email'].'|'.hst_time()));
        if($uinfo['gid'] != '99') {
            $roleInfo = CommonRoleModel::getInfo($uinfo['gid']);
            $route = Route::currentRouteName();
            if($route && !in_array($route, ['manageIndex', 'manageHome', 'manageUserInfoEdit', 'manageUserInfoEditSave']) && !in_array($route, $roleInfo['auths'])) {
                if(substr_count($_SERVER['HTTP_ACCEPT'], 'application/json')) {
                    $viewData = [
                        'message'=> hst_lang('hstcms::manage.no.auth'),
                        'referer'=> '',
                        'state' => 'fail',
                        'with' => 0
                    ];
                    return response()->json($viewData);
                }
                if($request->get('_ajax')){
                    
                }
                return back()->with(['state'=>'error', 'message'=> hst_lang('hstcms::manage.no.auth')]);
            }
        }
        $request->attributes->add(['managerInfo'=>$uinfo]);    //添加参数
        return $next($request);
    }
}
