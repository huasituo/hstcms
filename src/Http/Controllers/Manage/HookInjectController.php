<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Model\HookModel;
use Huasituo\Hstcms\Model\HookInjectModel;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class HookInjectController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($hook_name, Request $request)
    {
        $this->navs = [
            'return'=>['name'=>hst_lang('hstcms::public.go.back'), 'url'=>route('manageHookIndex')],
            'index'=>['name'=>hst_lang('hstcms::hook.inject'), 'url'=>route('manageHookInjectIndex', ['name'=>$hook_name])],
            'add'=>['name'=>hst_lang('hstcms::hook.add.inject'), 'url'=>route('manageHookInjectAdd', ['name'=>$hook_name]), 'title'=>hst_lang('hstcms::hook.add.inject'), 'class'=>'J_dialog']
        ];
        $hook = HookModel::where('name', $hook_name)->first();
        $list = HookInjectModel::where('hook_name', $hook_name)->get()->toArray();
        $view = [
            'hook_name'=>$hook_name,
            'list'=>$list,
            'info'=>$hook,
            'navs'=>$this->getNavs('index')
        ];
    	return $this->loadTemplate('hstcms::manage.hook.inject_index', $view);
    }

    public function add($hook_name, Request $request)
    {
        if(!$hook_name) {
            return $this->showError('hstcms::public.no.id');
        }
        $hook = HookModel::where('name', $hook_name)->first();
        if(!$hook) {
            return $this->showError('hstcms::hook.empty');
        }
        $view = [
            'hook_name'=>$hook_name
        ];
        return $this->loadTemplate('hstcms::manage.hook.inject_add', $view);
    }

    public function addSave($hook_name, Request $request)
    {
        $hook = HookModel::where('name', $hook_name)->first();
        if(!$hook) {
            return $this->showError('hstcms::hook.empty');
        }

        $validator = Validator::make($request->all(), [
            'alias' => 'required',
            'files' => 'required',
            'class' => 'required',
            'fun' => 'required'
        ],[
            'alias.required'=>hst_lang('hstcms::hook.alias.empty'),
            'files.required'=>hst_lang('hstcms::hook.files.empty'),
            'class.required'=>hst_lang('hstcms::hook.class.empty'),
            'fun.required'=>hst_lang('hstcms::hook.fun.empty'),
        ]);

        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $hookInject = HookInjectModel::where('hook_name', trim($hook_name))->where('alias', $request->get('alias'))->first();
        if($hookInject) {
            return $this->showError('hstcms::hook.inject.noone');
        }
        HookInjectModel::addInfo(trim($hook_name), trim($request->get('alias')), trim($request->get('files')), trim($request->get('class')), trim($request->get('fun')), trim($request->get('description')));

        $this->addOperationLog(hst_lang('hstcms::hook.add.inject').':'.trim($hook_name).trim($request->get('alias')), '', ['hook_name'=>trim($hook_name), 'alias'=>trim($request->get('alias')), 'files'=>trim($request->get('files')), 'description'=>trim($request->get('description')), 'class'=>trim($request->get('class')), 'fun'=>trim($request->get('fun'))], array());
        return $this->showMessage('hstcms::public.add.success'); 
    }

    public function edit($hook_name, $id)
    {
        if(!$hook_name || !$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $hook = HookModel::where('name', $hook_name)->first();
        if(!$hook) {
            return $this->showError('hstcms::hook.empty');
        }
        $hookInject = HookInjectModel::where('hook_name', $hook_name)->where('id', $id)->first();
        if(!$hookInject) {
            return $this->showError('hstcms::hook.no.inject');
        }
        $view = [
            'hook_name'=> $hook_name,
            'id'=> $id,
            'info'=> $hookInject,
        ];
        return $this->loadTemplate('hstcms::manage.hook.inject_edit', $view);
    }

    public function editSave($hook_name, Request $request)
    {
        $id = $request->get('id');
        if(!$hook_name || !$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $hook = HookModel::where('name', $hook_name)->first();
        if(!$hook) {
            return $this->showError('hstcms::hook.empty');
        }
        $hookInject = HookInjectModel::where('hook_name', $hook_name)->where('id', $id)->first();
        if(!$hookInject) {
            return $this->showError('hstcms::hook.no.inject');
        }
        $validator = Validator::make($request->all(), [
            'alias' => 'required',
            'files' => 'required',
            'class' => 'required',
            'fun' => 'required'
        ],[
            'alias.required'=>hst_lang('hstcms::hook.alias.empty'),
            'files.required'=>hst_lang('hstcms::hook.files.empty'),
            'class.required'=>hst_lang('hstcms::hook.class.empty'),
            'fun.required'=>hst_lang('hstcms::hook.fun.empty'),
        ]);

        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $hookInject = HookInjectModel::where('hook_name', trim($hook_name))->where('alias', $request->get('alias'))->first();
        if($hookInject && $hookInject['id'] != $id) {
            return $this->showError('hstcms::hook.inject.noone');
        }

        HookInjectModel::editInfo($id, trim($hook_name), trim($request->get('alias')), trim($request->get('files')), trim($request->get('class')), trim($request->get('fun')), trim($request->get('description')));
        $this->addOperationLog(hst_lang('hstcms::hook.edit.inject').':'.$hook_name.trim($request->get('alias')), '', ['hook_name'=>trim($hook_name), 'alias'=>trim($request->get('alias')), 'files'=>trim($request->get('files')), 'description'=>trim($request->get('description')), 'class'=>trim($request->get('class')), 'fun'=>trim($request->get('fun'))], $hookInject->toArray());
        return $this->showMessage('hstcms::public.edit.success'); 
    }

    public function delete($hook_name, $id)
    {
        if(!$hook_name || !$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $hook = HookModel::where('name', $hook_name)->first();
        if(!$hook) {
            return $this->showError('hstcms::hook.empty');
        }
        $hookInject = HookInjectModel::where('hook_name', $hook_name)->where('id', $id)->first();
        if(!$hookInject) {
            return $this->showError('hstcms::hook.no.inject');
        }
        HookInjectModel::del('id', $id);
        $this->addOperationLog(hst_lang('hstcms::hook.delete.inject').':'.$hook_name.$hookInject['alias'], '', array(), $hookInject->toArray());
        return $this->showMessage('hstcms::public.delete.success'); 
    }
}

