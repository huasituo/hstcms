<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Model\ManageMenuModel;
use Huasituo\Hstcms\Model\CommonRoleUriModel;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class MenuController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function nav(Request $request)
    {
        $this->navs = [
            'nav'=>['name'=>hst_lang('hstcms::public.menu'), 'url'=>'manageMenuNav'],
            'role'=>['name'=>hst_lang('hstcms::manage.role.uri'), 'url'=>'manageMenuRole'],
            'add'=>['name'=>hst_lang('hstcms::public.add', 'hstcms::public.menu'), 'url'=>'manageMenuNavAdd', 'class'=>'J_dialog', 'title'=>hst_lang('hstcms::public.add', 'hstcms::public.menu')]
        ];
        $menus = ManageMenuModel::getList();
        $view = [
            'menus'=>$menus,
            'navs'=>$this->getNavs('nav')
        ];
    	return $this->loadTemplate('menu.nav', $view);
    }

    public function navAdd(Request $request)
    {
        $menus = ManageMenuModel::getList();
        $view = [
            'menus'=>$menus
        ];
        return $this->loadTemplate('menu.nav_add', $view);
    }

    public function navAddSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'ename' => 'required',
        ],[
            'name.required'=>hst_lang('hstcms::public.name.empty'),
            'ename.required' => hst_lang('hstcms::public.ename.empty'),
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $menu = ManageMenuModel::where('ename', trim($request->get('ename')))->first();
        if($menu) {
            return $this->showError('hstcms::public.ename.noone', 2);
        }
        $parent = trim($request->get('parent'));
        $data = [
            'name'=>trim($request->get('name')),
            'ename'=>trim($request->get('ename')),
            'url'=>trim($request->get('url')),
            'icon'=>trim($request->get('icon'))
        ];
        ManageMenuModel::addInfo($data, $parent);
        $this->addOperationLog(hst_lang('hstcms::manage.menu.nav.add').':'.trim($request->get('name')), '', $data, array());
        return $this->showMessage('hstcms::public.add.success'); 
    }

    public function navEdit($id)
    {
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $menu = ManageMenuModel::where('id', $id)->first();
        if(!$menu) {
            return $this->showError('hstcms::public.no.data');
        }
        $menus = ManageMenuModel::getList();
        $view = [
            'id'=>$id,
            'info'=>$menu,
            'menus'=>$menus
        ];
        return $this->loadTemplate('menu.nav_edit', $view);
    }

    public function navEditSave(Request $request)
    {
        $id = (int)$request->get('id');
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $menu = ManageMenuModel::where('id', $id)->first();
        if(!$menu) {
            return $this->showError('hstcms::public.no.data');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'ename' => 'required',
        ],[
            'name.required'=>hst_lang('hstcms::public.name.empty'),
            'ename.required' => hst_lang('hstcms::public.ename.empty'),
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $_menu = ManageMenuModel::where('ename', trim($request->get('ename')))->first();
        if($_menu && $_menu['id'] != $id) {
            return $this->showError('hstcms::public.ename.noone');
        }

        $parent = trim($request->get('parent'));
        $data = [
            'name'=>trim($request->get('name')),
            'ename'=>trim($request->get('ename')),
            'url'=>trim($request->get('url')),
            'icon'=>trim($request->get('icon'))
        ];
        ManageMenuModel::editInfo($id, $data, $parent, $menu);
        $this->addOperationLog(hst_lang('hstcms::manage.menu.nav.edit').':'.$data['name'], '', $data, $menu->toArray());
        return $this->showMessage('hstcms::public.save.success'); 
    }

    public function navDelete($id)
    {
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $menu = ManageMenuModel::where('id', $id)->first();
        if(!$menu) {
            return $this->showError('hstcms::public.no.data');
        }
        ManageMenuModel::where('id', $id)->delete();
        $this->addOperationLog(hst_lang('hstcms::manage.menu.nav.delete').':'.$menu['name'], '', array(), $menu->toArray());
        return $this->showMessage('hstcms::public.delete.success'); 
    }
    // ====================================
    public function role(Request $request)
    {
        if($request->get('_ajax')) {
            $ename = $request->input('ename');
            $parent = $request->input('parent');
            $uri = $request->input('uri');
            $query = CommonRoleUriModel::where('id', '>', 0);
            if($ename) {
                $query->where('ename', $ename);
            }
            if($uri) {
                $query->where('uri', $uri);
            }
            if($parent) {
                $query->where('parent', $parent);
            }
            $list = $query->orderby('id', 'desc')->paginate($this->paginate);
            $this->addMessage($list, 'list');
            return $this->showMessage('Hstcms::public.successful');
        }
        $view = [
            'navs'=>$this->getNavs('operation')
        ];
        $this->navs = [
            'nav'=>['name'=>hst_lang('hstcms::public.menu'), 'url'=>'manageMenuNav'],
            'role'=>['name'=>hst_lang('hstcms::manage.role.uri'), 'url'=>'manageMenuRole'],
            'add'=>['name'=>hst_lang('hstcms::public.add', 'hstcms::manage.role.uri'), 'url'=>'manageMenuRoleAdd', 'class'=>'J_dialogs', 'title'=>hst_lang('hstcms::public.add', 'hstcms::manage.role.uri')]
        ];
        $view = [
            'navs'=>$this->getNavs('role')
        ];
        return $this->loadTemplate('menu.role', $view);
    }

    public function roleAdd(Request $request)
    {
        $id = $request->get('id');
        $info = [];
        if($id) {
            $info = CommonRoleUriModel::where('id', $id)->first();
        }
        $view = [
            'info'=>$info
        ];
        return $this->loadTemplate('menu.role_add', $view);
    }

    public function roleAddSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'ename' => 'required',
            'uri' => 'required',
            'parent' => 'required',
        ],[
            'name.required'=>hst_lang('hstcms::public.name.empty'),
            'ename.required' => hst_lang('hstcms::public.ename.empty'),
            'uri.required' => hst_lang('hstcms::public.uri.empty'),
            'parent.required' => hst_lang('hstcms::public.ascription.empty'),
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $roleUri = CommonRoleUriModel::where('ename', trim($request->get('ename')))->first();
        if($roleUri) {
            return $this->showError('hstcms::public.ename.noone');
        }
        $data = [
            'name'=>trim($request->get('name')),
            'ename'=>trim($request->get('ename')),
            'uri'=>trim($request->get('uri')),
            'remark'=>trim($request->get('remark')),
            'parent'=>trim($request->get('parent'))
        ];
        CommonRoleUriModel::addInfo($data);
        $this->addOperationLog(hst_lang('hstcms::manage.role.uri.add').':'.trim($request->get('name')), '', $data, array());
        return $this->showMessage('hstcms::public.add.success'); 
    }

    public function roleEdit($id)
    {
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $info = CommonRoleUriModel::where('id', $id)->first();
        if(!$info) {
            return $this->showError('hstcms::public.no.data');
        }
        $view = [
            'id'=>$id,
            'info'=>$info
        ];
        return $this->loadTemplate('menu.role_edit', $view);
    }

    public function roleEditSave(Request $request)
    {
        $id = (int)$request->get('id');
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $roleUri = CommonRoleUriModel::where('id', $id)->first();
        if(!$roleUri) {
            return $this->showError('hstcms::public.no.data');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'ename' => 'required',
            'uri' => 'required',
            'parent' => 'required',
        ],[
            'name.required'=>hst_lang('hstcms::public.name.empty'),
            'ename.required' => hst_lang('hstcms::public.ename.empty'),
            'uri.required' => hst_lang('hstcms::public.uri.empty'),
            'parent.required' => hst_lang('hstcms::public.ascription.empty'),
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $info = CommonRoleUriModel::where('ename', trim($request->get('ename')))->first();
        if($info && $info['id'] != $id) {
            return $this->showError('hstcms::public.ename.noone');
        }

        $data = [
            'name'=>trim($request->get('name')),
            'ename'=>trim($request->get('ename')),
            'uri'=>trim($request->get('uri')),
            'remark'=>trim($request->get('remark')),
            'parent'=>trim($request->get('parent'))
        ];
        CommonRoleUriModel::editInfo($id, $data);
        $this->addOperationLog(hst_lang('hstcms::manage.role.uri.edit').':'.$data['name'], '', $data, $roleUri->toArray());
        return $this->showMessage('hstcms::public.save.success'); 
    }

    public function roleDelete($id)
    {
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $info = ManageMenuModel::where('id', $id)->first();
        if(!$info) {
            return $this->showError('hstcms::public.no.data');
        }
        CommonRoleUriModel::where('id', $id)->delete();
        $this->addOperationLog(hst_lang('hstcms::manage.role.uri.delete').':'.$info['name'], '', array(), $info->toArray());
        return $this->showMessage('hstcms::public.delete.success'); 
    }
}

