<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Model\ManageUserModel;
use Huasituo\Hstcms\Model\CommonRoleModel;
use Huasituo\Hstcms\Model\CommonRoleUriModel;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class UserController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
        $this->navs = [
            'user'=>['name'=>hst_lang('hstcms::public.user'), 'url'=>'manageUserIndex'],
            'role'=>['name'=>hst_lang('hstcms::public.role'), 'url'=>'manageRoleIndex']
        ];
    }

    public function index(Request $request)
    {
        $users = ManageUserModel::getUsers();
        $roles = CommonRoleModel::getRoles();
        $this->navs['add'] = ['name'=>hst_lang('hstcms::public.add').hst_lang('hstcms::public.user'), 'url'=>'manageUserAdd', 'class'=>'J_dialog', 'title'=>hst_lang('hstcms::public.add').hst_lang('hstcms::public.user')];
        $view = [
            'users'=>$users,
            'roles'=>$roles,
            'navs'=>$this->getNavs('user')
        ];
    	return $this->loadTemplate('user.index', $view);
    }

    public function add(Request $request)
    {
        $roles = CommonRoleModel::getRoles();
        $view = [
            'roles'=>$roles,
        ];
        return $this->loadTemplate('user.add', $view);
    }

    public function addSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gid' => 'required',
            'username' => 'required',
            'password' => 'required|between:6,16|string',
            'name' => 'required',
            //'email' => 'required|email',
            'mobile' => 'required'
        ],[
            'gid.required'=>hst_lang('hstcms::manage.enter.one.role.name'),
            'username.required'=>hst_lang('hstcms::public.username.empty'),
            'password.required'=>hst_lang('hstcms::public.password.empty'),
            'password.between' => hst_lang('hstcms::public.password.length.tips'),
            'name.required' => hst_lang('hstcms::public.realname.empty'),
            'mobile.required'=>hst_lang('hstcms::public.mobile.empty'),
            //'email.required'=>hst_lang('hstcms::public.email.empty'),
            //'email.email'=>hst_lang('hstcms::public.email.error')
        ]);

        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }

        if ($request->get('gid') < 1) {
            return $this->showError(hst_lang('hstcms::manage.select.role'));
        }
        $user = ManageUserModel::where('username', trim($request->get('username')))->first();
        if($user) {
            return $this->showError('hstcms::manage.founder.username.noone');
        }
        $salt = hst_random(6);
        $postData = [
            'username'=>trim($request->get('username')),
            'password'=>trim(hst_md5(trim($request->get('password')), $salt)),
            'salt'=>$salt,
            'name'=>trim($request->get('name')),
            'mobile'=>trim($request->get('mobile')),
            'email'=>trim($request->get('email')),
            'weixin'=>trim($request->get('weixin')),
            'qq'=>trim($request->get('qq')),
            'status'=>hst_switch($request, 'status', true),
            'gid'=>trim($request->get('gid'))
        ];
        ManageUserModel::insert($postData);
        ManageUserModel::setCache();
        $this->addOperationLog(hst_lang('hstcms::manage.founder.add').':'.trim($request->get('username')), '', $postData, array());
        return $this->showMessage('hstcms::public.add.success'); 
    }

    public function edit($uid)
    {
        if(!$uid) {
            return $this->showError('hstcms::public.no.id');
        }
        $user = ManageUserModel::where('uid', $uid)->first();
        if(!$user) {
            return $this->showError('hstcms::public.no.data');
        }
        $roles = CommonRoleModel::getRoles();
        $view = [
            'info'=>$user,
            'uid'=>$uid,
            'roles'=>$roles,
        ];
        return $this->loadTemplate('user.edit', $view);
    }

    public function editSave(Request $request)
    {
        $uid = (int)$request->get('uid');
        if(!$uid) {
            return $this->showError('hstcms::public.no.id');
        }
        $user = ManageUserModel::where('uid', $uid)->first();
        if(!$user) {
            return $this->showError('hstcms::public.no.data');
        }
        $validator = Validator::make($request->all(), [
            //'password' => 'between:6,16|string',
            'name' => 'required',
            //'email' => 'required|email',
            'mobile' => 'required',
        ],[
            //'password.required'=>hst_lang('hstcms::public.password.empty'),
            //'password.between' => hst_lang('hstcms::public.password.length.tips'),
            'name.required' => hst_lang('hstcms::public.realname.empty'),
            'mobile.required'=>hst_lang('hstcms::public.mobile.empty'),
            //'email.required'=>hst_lang('hstcms::public.email.empty'),
            //'email.email'=>hst_lang('hstcms::public.email.empty')
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        if ($request->get('gid') < 1) {
            return $this->showError(hst_lang('hstcms::manage.select.role'));
        }
        $editData = [
            'name'=>trim($request->get('name')),
            'mobile'=>trim($request->get('mobile')),
            'email'=>trim($request->get('email')),
            'weixin'=>trim($request->get('weixin')),
            'qq'=>trim($request->get('qq')),
            'status'=>hst_switch($request, 'status', true),
            'gid'=>trim($request->get('gid'))
        ];
        if($request->get('password')) {
            $editData['password'] = trim(hst_md5(trim($request->get('password')), $user['salt']));
        }
        ManageUserModel::where('uid', $uid)->update($editData);
        ManageUserModel::setCache();
        $this->addOperationLog(hst_lang('hstcms::manage.founder.user.edit').':'.$user['username'], '', $editData, $user->toArray());
        return $this->showMessage('hstcms::public.save.success'); 
    }

    public function delete($uid)
    {
        if(!$uid) {
            return $this->showError('hstcms::public.no.id');
        }
        $user = ManageUserModel::where('uid', $uid)->first();
        if(!$user) {
            return $this->showError('hstcms::public.no.data');
        }
        if($uid == hst_manager('uid')) {
            return $this->showError('hstcms::manage.founder.delete.my');
        }
        ManageUserModel::where('uid', $uid)->delete();
        ManageUserModel::setCache();
        $this->addOperationLog(hst_lang('hstcms::manage.founder.user.delete').':'.$user['username'], '', array(), $user->toArray());
        return $this->showMessage('hstcms::public.delete.success'); 
    }
}

