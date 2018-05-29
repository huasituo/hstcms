<?php 

namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Model\CommonSpecialModel;

use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;

class SpecialController extends BasicController
{
    public $module = 'site';
    public $relatedid = 0;

    public function __construct(Request $request)
    {
        parent::__construct();
        $module = $request->get('module');
        if($module) {
            $this->module = $module;
        }
        $this->navs = [
            'index'=>['name'=>hst_lang('hstcms::manage.special.manage'), 'url'=>route('manageSpecialIndex', ['module'=>$this->module])],
            'add'=>['name'=>hst_lang('hstcms::manage.special.add'), 'url'=>route('manageSpecialAdd', ['module'=>$this->module]), 'class'=>'J_dialog', 'title'=>hst_lang('hstcms::manage.special.add')],
            'cache'=>['name'=>hst_lang('hstcms::public.update.cache'), 'url'=>route('manageSpecialCache', ['module'=>$this->module])]
        ];
        $this->viewData['module'] = $this->module;
    }

    public function index(Request $request)
    {
        $data = CommonSpecialModel::getData($this->module, 'lists');
        $view = [
            'list'=>$data,
            'navs'=>$this->getNavs('index')
        ];
    	return $this->loadTemplate('hstcms::manage.special.index', $view);
    }

    public function add(Request $request)
    {
        $view = [
        ];
        return $this->loadTemplate('hstcms::manage.special.add', $view);
    }

    public function addSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'dir' => 'required'
        ],[
            'name.required'=>hst_lang('hstcms::manage.special.name.empty'),
            'dir.required'=>hst_lang('hstcms::manage.special.dir.empty')
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $dirinfo = CommonSpecialModel::hasSpecial($request->get('dir'), $this->module);
        if($dirinfo) {
            return $this->showError('hstcms::manage.special.dir.one');
        }
        $psotData = [
            'name'=>$request->get('name'),
            'title'=>$request->get('title'),
            'module'=>$this->module,
            'keywords'=>$request->get('keywords'),
            'description'=>$request->get('description'),
            'domain'=>$request->get('domain'),
            'style'=>$request->get('style'),
            'dir'=>$request->get('dir'),
            'content'=>(string)$request->get('content'),
            'isopen'=>(int)hst_switch($request->all(), 'isopen'),
            'header'=>(int)hst_switch($request->all(), 'header'),
            'footer'=>(int)hst_switch($request->all(), 'footer'),
        ];
        $id = CommonSpecialModel::insertGetId($psotData);
        if(!$id) {
            return $this->showError('hstcms::public.error');
        }
        CommonSpecialModel::setCache($this->module);
        CommonSpecialModel::setCache('all');
        CommonSpecialModel::addInfo($id, $psotData);
        $this->addOperationLog(hst_lang('hstcms::manage.special.add').':'.trim($request->get('name')), '', $psotData, []);
        return $this->showMessage('hstcms::public.add.success'); 
    }

    public function edit($id, Request $request)
    {
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $info = CommonSpecialModel::getInfo($id, $this->module);
        if(!$info) {
            return $this->showError('hstcms::public.no.data');
        }
        $view = [
            'id'=> $id,
            'info'=> $info,
        ];
        return $this->loadTemplate('hstcms::manage.special.edit', $view);
    }

    public function editSave(Request $request)
    {
        $id = $request->get('id');
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $info = CommonSpecialModel::getInfo($id, $this->module);
        if(!$info) {
            return $this->showError('hstcms::public.no.data');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ],[
            'name.required'=>hst_lang('hstcms::manage.special.name.empty')
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $dirinfo = CommonSpecialModel::hasSpecial($request->get('dir'), $this->module, $id);
        if($dirinfo) {
            return $this->showError('hstcms::manage.special.dir.one');
        }
        $psotData = [
            'name'=>$request->get('name'),
            'title'=>$request->get('title'),
            'keywords'=>$request->get('keywords'),
            'description'=>$request->get('description'),
            'style'=>$request->get('style'),
            'domain'=>$request->get('domain'),
            'dir'=>$request->get('dir'),
            'content'=>(string)$request->get('content'),
            'isopen'=>(int)hst_switch($request->all(), 'isopen'),
            'header'=>(int)hst_switch($request->all(), 'header'),
            'footer'=>(int)hst_switch($request->all(), 'footer'),
        ];
        CommonSpecialModel::where('id', $id)->update($psotData);
        CommonSpecialModel::setCache($this->module);
        CommonSpecialModel::setCache('all');
        $this->addOperationLog(hst_lang('hstcms::manage.special.edit').':'.$id, '', $psotData, $info);
        return $this->showMessage('hstcms::public.edit.success'); 
    }

    public function delete($id)
    {

        if(!$id) {
            return $this->showError('hstcms::public.no.id', 5);
        }
        $info = CommonSpecialModel::getInfo($id, $this->module);
        if(!$info) {
            return $this->showError('hstcms::public.no.data', 5);
        }
        CommonSpecialModel::deleteSpecial($id);
        CommonSpecialModel::setCache($this->module);
        CommonSpecialModel::setCache('all');
        $this->addOperationLog(hst_lang('hstcms::manage.special.delete').':'.$id, '', [], $info);
        return $this->showMessage('hstcms::public.delete.success', 5); 
    }

    public function cache() 
    {
        CommonSpecialModel::setCache($this->module);
        CommonSpecialModel::setCache('all');
        $this->addOperationLog(hst_lang('hstcms::manage.special.cache'));
        return $this->showMessage('hstcms::public.successful', 5); 
    }

}

