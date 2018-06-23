<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Http\Controllers\Manage\BasicController;

use Huasituo\Hstcms\Model\ManageUserModel;
use Huasituo\Hstcms\Model\ManageLoginLogModel;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends BasicController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 后台登录页面
     */
    public function login()
    {
        if (Session::get('manager')) {
            return redirect()->route('manageIndex');
        }
        $this->addMessage(hst_lang('hstcms::manage.login.title'), 'seo_title');
        return $this->loadTemplate('login');
    }

    /**
     * @param Request $request
     */
    public function doLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|between:6,16|string'
        ],[
            'username.required'=>hst_lang('hstcms::public.username.empty'),
            'password.required'=> hst_lang('hstcms::public.password.empty'),
            'password.between' => hst_lang('hstcms::public.password.length.tips')
        ]);
        if ($validator->fails()) {
            return $this->showError($validator, 'manageAuthLogin', 2);
        }
        if (!ManageUserModel::checkPassword($request->get('username'), $request->get('password'))) {
            ManageLoginLogModel::addLog(['uid'=>0, 'username'=>$request->get('username')], hst_lang('hstcms::public.password.error'));
            return $this->showError(['password'=> hst_lang('hstcms::public.password.error')], 'manageAuthLogin', 2);
        }
        $user = ManageUserModel::where('username', $request->get('username'))->first();
        if($user['status'] == 1) {
            ManageLoginLogModel::addLog($user, hst_lang('hstcms::manage.user.disable'));
            return $this->showError(['password'=> hst_lang('hstcms::manage.user.disable')], 'manageAuthLogin', 2);
        }
        ManageLoginLogModel::addLog($user, hst_lang('hstcms::public.login.success'));
        ManageUserModel::managerDoLogin($user);
        return redirect()->route('manageIndex');
    }

    /**
     * 后台登出
     */
    public function logout()
    {
        ManageLoginLogModel::addLog(hst_manager(), hst_lang('hstcms::public.logout.success'));
        Session::forget('manager');
        return redirect()->route('manageAuthLogin');
    }
}
