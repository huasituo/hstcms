<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Model\ManageUserModel;
use Huasituo\Hstcms\Model\CommonRoleModel;
use Huasituo\Hstcms\Model\ManageMenuModel;
use Huasituo\Hstcms\Model\CommonRoleUriModel;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class RoleController extends BasicController
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
        $roles = CommonRoleModel::get();
        $this->navs['add'] = ['name'=>hst_lang('hstcms::public.add', 'hstcms::public.role'), 'url'=>'manageRoleAdd'];
        $view = [
            'roles'=>$roles,
            'navs'=>$this->getNavs('role')
        ];
    	return $this->loadTemplate('role.index', $view);
    }

    public function add(Request $request)
    {
        $menus = ManageMenuModel::getMenu();
        $roleUriDatas = CommonRoleUriModel::getRoleUriDatas();
        $this->navs['add'] = ['name'=>hst_lang('hstcms::public.add', 'hstcms::public.role'), 'url'=>'manageRoleAdd'];
        $view = [
            'navs'=>$this->getNavs('add'),
            'menus'=>$menus,
            'roleUriDatas'=>$roleUriDatas
        ];
        return $this->loadTemplate('role.add', $view);
    }

    public function addSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ],[
            'name.required'=>hst_lang('hstcms::manage.role.name.empty'),
        ]);
        if ($validator->fails())
        {
            return $this->showError($validator->errors(), 2);
        }
        $role = CommonRoleModel::where('name', trim($request->get('name')))->first();
        if($role) {
            return $this->showError('hstcms::manage.role.name.one');
        }
        $postData = [
            'module'=>'manage',
            'name'=>trim($request->get('name')),
            'auths'=>implode(',', (array) $request->get('auths'))
        ];
        CommonRoleModel::insert($postData);
        CommonRoleModel::setCache();
        $this->addOperationLog(hst_lang('hstcms::public.add', 'hstcms::public.role').':'.trim($request->get('name')), '', $postData, array());
        return $this->showMessage('hstcms::public.add.success', 'manageRoleIndex');
    }

    public function edit($id)
    {
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $info = CommonRoleModel::where('id', $id)->first();
        if(!$info) {
            return $this->showError('hstcms::public.no.data');
        }
        $info['auths'] = explode(',', $info['auths']);
        $this->navs['edit'] = ['name'=>hst_lang('hstcms::manage.role.edit'), 'url'=>route('manageRoleEdit', ['id'=>$id])];
        $menus = ManageMenuModel::getMenu();
        $roleUriDatas = CommonRoleUriModel::getRoleUriDatas();
        $view = [
            'navs'=>$this->getNavs('edit'),
            'info'=>$info,
            'id'=>$id,
            'menus'=>$menus,
            'roleUriDatas'=>$roleUriDatas
        ];
        return $this->loadTemplate('role.edit', $view);
    }

    public function editSave(Request $request)
    {
        $id = $request->get('id');
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $role = CommonRoleModel::where('id', $id)->first();
        if(!$role) {
            return $this->showError('hstcms::public.no.data');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ],[
            'name.required'=>hst_lang('hstcms::manage.role.name.empty'),
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $editData = [
            'name'=>trim($request->get('name')),
            'auths'=>implode(',', (array) $request->get('auths'))
        ];
        CommonRoleModel::where('id', $id)->update($editData);
        CommonRoleModel::setCache();
        $this->addOperationLog(hst_lang('hstcms::manage.role.edit').':'.trim($request->get('name')), '', $editData, $role->toArray());
        return $this->showMessage('hstcms::public.edit.success');
    }

    public function delete($id)
    {
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $role = CommonRoleModel::where('id', $id)->first();
        if(!$role) {
            return $this->showError('hstcms::public.no.data');
        }
        $userCount = ManageUserModel::where('gid', $id)->count();
        if($userCount) {
            return $this->showError('hstcms::manage.role.delete.error.001');
        }
        CommonRoleModel::where('id', $id)->delete();
        CommonRoleModel::setCache();
        $this->addOperationLog(hst_lang('hstcms::manage.role.delete').':'.$role['name'], '', $role->toArray());
        return $this->showMessage('hstcms::public.delete.success');
    }
}

