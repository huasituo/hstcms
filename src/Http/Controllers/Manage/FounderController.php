<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Model\ManageUserModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class FounderController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
        $this->navs = [
            'add'=>['name'=>hst_lang('hstcms::manage.founder.add'), 'url'=>'manageFounderAdd', 'class'=>'J_dialog', 'title'=>hst_lang('hstcms::manage.founder.add')]
        ];
    }

    public function index(Request $request)
    {
        $founders = ManageUserModel::getFounder();
        $view = [
            'founders'=>$founders,
            'navs'=>$this->getNavs('index', true)
        ];
    	return $this->loadTemplate('founder.index', $view);
    }

    public function add(Request $request)
    {
        return $this->loadTemplate('founder.add');
    }

    public function addSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|between:6,16|string',
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
        ],[
            'username.required'=>hst_lang('hstcms::public.username.empty'),
            'password.required'=>hst_lang('hstcms::public.password.empty'),
            'password.between' => hst_lang('hstcms::public.password.length.tips'),
            'name.required' => hst_lang('hstcms::public.realname.empty'),
            'mobile.required'=>hst_lang('hstcms::public.mobile.empty'),
            'email.required'=>hst_lang('hstcms::public.email.empty'),
            'email.email'=>hst_lang('hstcms::public.email.error')
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
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
            'gid'=>99
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
        $user = ManageUserModel::getUser($uid);
        if(!$user) {
            return $this->showError('hstcms::public.no.data');
        }
        $view = [
            'info'=>$user,
            'uid'=>$uid
        ];
        return $this->loadTemplate('founder.edit', $view);
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
            'email' => 'required|email',
            'mobile' => 'required',
        ],[
            //'password.required'=>hst_lang('hstcms::manage.user.password.empty'),
            //'password.between' => hst_lang('hstcms::manage.user.password.length.tips'),
            'name.required' => hst_lang('hstcms::public.realname.empty'),
            'mobile.required'=>hst_lang('hstcms::public.mobile.empty'),
            'email.required'=>hst_lang('hstcms::public.email.empty'),
            'email.email'=>hst_lang('hstcms::public.email.error')
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $editData = [
            'name'=>trim($request->get('name')),
            'mobile'=>trim($request->get('mobile')),
            'email'=>trim($request->get('email')),
            'weixin'=>trim($request->get('weixin')),
            'qq'=>trim($request->get('qq')),
            'status'=>hst_switch($request, 'status', true)
        ];
        if($request->get('password')) {
            $editData['password'] = trim(hst_md5(trim($request->get('password')), $user['salt']));
        }
        ManageUserModel::where('uid', $uid)->update($editData);
        ManageUserModel::setCache();
        $this->addOperationLog(hst_lang('hstcms::manage.founder.edit').':'.$user['username'], '', $editData, $user->toArray());
        return $this->showMessage('hstcms::public.edit.success'); 
    }

    public function delete($uid)
    {
        if(!$uid) {
            return $this->showError('hstcms::public.no.id');
        }
        $user = ManageUserModel::getUser($uid);
        if(!$user) {
            return $this->showError('hstcms::public.no.data');
        }
        if($uid == hst_manager('uid')) {
            return $this->showError('hstcms::manage.founder.delete.my');
        }
        $count = ManageUserModel::where('gid', 99)->count();
        if($count < 2) {
            return $this->showError('hstcms::manage.founder.one');
        }
        ManageUserModel::where('uid', $uid)->delete();
        ManageUserModel::setCache();
        $this->addOperationLog(hst_lang('hstcms::manage.founder.delete').':'.$user['username'], '', array(), $user->toArray());
        return $this->showMessage('hstcms::public.delete.success'); 
    }
}

