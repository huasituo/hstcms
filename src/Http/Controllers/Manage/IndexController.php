<?php 

namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Model\ManageMenuModel;
use Huasituo\Hstcms\Model\ManageUserModel;
use Huasituo\Hstcms\Model\CommonRoleModel;
use Huasituo\Hstcms\Model\ManageLoginLogModel;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class IndexController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $user = hst_manager();
        $menus = ManageMenuModel::getMenu($user);
        $view = [
            'menus' => json_encode($menus),
            'userInfo'=>$user
        ];
    	return $this->loadTemplate('index', $view);
    }

    public function main(Request $request)
    {
        $user = hst_manager();
        $view = [
            'userInfo'=>$user
        ];
        return $this->loadTemplate('home', $view);
    }

    public function customSet(Request $request)
    {

    }

    public function userInfoEdit($uid, Request $request)
    {
        if(!$uid) {
            return $this->showError('hstcms::public.no.id');
        }
        $user = ManageUserModel::where('uid', $uid)->first();
        if(!$user) {
            return $this->showError('hstcms::public.no.data');
        }
        if($user['uid'] != hst_manager('uid')) {
            return $this->showError('hstcms::public.no.id');
        }
        $view = [
            'info'=>$user,
            'uid'=>$uid
        ];
        return $this->loadTemplate('user.edit_info', $view);
    }

    public function userInfoEditSave(Request $request)
    {
        $uid = (int)$request->get('uid');
        if(!$uid) {
            return $this->showError('hstcms::public.no.id');
        }
        $user = ManageUserModel::where('uid', $uid)->first();
        if(!$user) {
            return $this->showError('hstcms::public.no.data');
        }
        if($user['uid'] != hst_manager('uid')) {
            return $this->showError('hstcms::public.no.id');
        }
        $validator = Validator::make($request->all(), [
            //'password' => 'between:6,16|string',
            'name' => 'required',
            'mobile' => 'required',
        ],[
            //'password.required'=>hst_lang('hstcms::manage.user.password.empty'),
            //'password.between' => hst_lang('hstcms::manage.user.password.length.tips'),
            'name.required' => hst_lang('hstcms::public.realname.empty'),
            'mobile.required'=>hst_lang('hstcms::public.mobile.empty')
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $editData = [
            'name'=>trim($request->get('name')),
            'mobile'=>trim($request->get('mobile')),
            'email'=>trim($request->get('email')),
            'weixin'=>trim($request->get('weixin')),
            'qq'=>trim($request->get('qq'))
        ];
        if($request->get('password')) {
            $editData['password'] = trim(hst_md5(trim($request->get('password')), $user['salt']));
        }
        ManageUserModel::where('uid', $uid)->update($editData);
        ManageUserModel::setCache();
        $this->addOperationLog(hst_lang('hstcms::manage.founder.user.edit').':'.$user['username'], '', $editData, $user);
        if($request->get('password')) {
            ManageLoginLogModel::addLog(hst_manager(), hst_lang('hstcms::manage.founder.user.edit').hst_lang('hstcms::manage.logout.success'));
            Session::forget('manager');
            return $this->showMessage('hstcms::public.edit.success', route('manageAuthLogin')); 
        }
        return $this->showMessage('hstcms::public.edit.success'); 
    }
}

