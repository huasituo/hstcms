<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Model\CommonFormModel;
use Huasituo\Hstcms\Model\CommonFieldsModel;

use Huasituo\Hstcms\Libraries\HstcmsFields;


use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class FieldsController extends BasicController
{
    public $rname = 'form';
    public $relatedid = 0;
    public $hstcmsFields = null;
    public $formInfo = null;
    public $relatedtable = '';
    public $module = '';

    public function __construct(Request $request)
    {
        parent::__construct();
        $this->rname = $request->get('rname');
        $this->relatedtable = $request->get('relatedtable');
        $this->relatedid = (int)$request->get('relatedid');
        $this->viewData['rname'] = $this->rname;
        $this->viewData['relatedid'] = $this->relatedid;
        $this->hstcmsFields = new HstcmsFields();
        if($this->rname == 'form') {
            $this->formInfo = CommonFormModel::getForm($this->relatedid);
            if($this->formInfo) {
                $this->relatedtable = $this->formInfo['table'];
                $this->module = $this->formInfo['module'];
            }
        } else {
            $this->module = $this->rname;
        }
        $this->navs = [
            'index'=>['name'=>hst_lang('hstcms::manage.fields.manage'), 'url'=>route('manageFieldsIndex', [
                'rname' => $this->rname,
                'relatedid' => $this->relatedid,
                'relatedtable' => $this->relatedtable
            ])],
            'add'=>['name'=>hst_lang('hstcms::manage.fields.add'), 'url'=>route('manageFieldsAdd', [
                'rname' => $this->rname,
                'relatedid' => $this->relatedid,
                'relatedtable' => $this->relatedtable
            ])]
        ];
    }

    public function index(Request $request)
    {
        if($this->rname == 'form') {
            if(!$this->formInfo) {
                    return $this->showError('hstcms::manage.form.no.info');
            }
            $fields = CommonFieldsModel::getFields($this->formInfo['table'], $this->formInfo['module']);
        } else {
            $fields = CommonFieldsModel::getFields($this->relatedtable, $this->module);
        }
        $view = [
            'list'=>$fields,
            'navs'=>$this->getNavs('index')
        ];
    	return $this->loadTemplate('hstcms::manage.fields.index', $view);
    }

    public function save(Request $request)
    {
        $vieworder = $request->get('vieworder');
        foreach ($vieworder as $id => $value) {
            CommonFieldsModel::where('id', $id)->update(['vieworder'=>$value]);
        }
        CommonFieldsModel::setCache($this->relatedtable);
        CommonFieldsModel::setCache('all');
        $this->addOperationLog(hst_lang('hstcms::manage.fields.update.vieworder'), '', [], []);
        return $this->showMessage('hstcms::public.add.success', 5); 
    }

    public function add(Request $request)
    {
        $view = [
            'fieldTypes'=> $this->hstcmsFields->type(),
            'navs'=>$this->getNavs('add')
        ];
        return $this->loadTemplate('hstcms::manage.fields.add', $view);
    }

    public function addSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'fieldname' => 'required',
            'fieldtype' => 'required'
        ],[
            'name.required'=>hst_lang('hstcms::manage.fields.name.empty'),
            'fieldname.required'=>hst_lang('hstcms::manage.fields.fieldname.empty'),
            'fieldtype.required'=>hst_lang('hstcms::manage.fields.type.empty')
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        if($this->rname == 'form') {
            if(!$this->formInfo) {
                return $this->showError('hstcms::manage.form.no.info');
            }
            if(!CommonFieldsModel::hasFieldOrColumn([
                'relatedtable'=>$this->formInfo['table'],
                'module'=>$this->formInfo['module'],
                'fieldname'=>$request->get('fieldname')
            ])) {
                return $this->showError('hstcms::manage.fields.one');
            }
            $ismain = 1;
        }
        $setting = $request->get('setting');
        $setting['validate']['isedit'] = (int)hst_switch($request->all(), 'isedit');
        $setting['option']['isfrontshow'] = (int)hst_switch($request->all(), 'isfrontshow');
        $psotData = [
            'name'=>$request->get('name'),
            'fieldtype'=>$request->get('fieldtype'),
            'fieldname'=>$request->get('fieldname'),
            'vieworder'=>(int)$request->get('vieworder'),
            'ismshow'=>(int)hst_switch($request->all(), 'ismshow'),
            'issearch'=>(int)hst_switch($request->all(), 'issearch'),
            'disabled'=>(int)hst_switch($request->all(), 'disabled', true),
            'ismain'=>$ismain,
            'relatedtable'=>$this->relatedtable,
            'module'=>$this->module,
            'relatedid'=>$this->relatedid,
            'setting'=>$setting
        ];
        CommonFieldsModel::addField($psotData);
        CommonFieldsModel::setCache('all');
        CommonFieldsModel::setCache($this->relatedtable);
        $this->addOperationLog(hst_lang('hstcms::manage.fields.add').':'.trim($request->get('name')), '', $psotData, []);
        return $this->showMessage('hstcms::public.add.success', '', 5); 
    }

    public function edit($id)
    {
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $info = CommonFieldsModel::getField($id);
        if(!$info) {
            return $this->showError('hstcms::public.no.data');
        }
        $this->navs['edit'] = ['name'=>hst_lang('hstcms::manage.fields.edit'), 'url'=>route('manageFieldsEdit', [
                'id' => $id,
                'rname' => $this->rname,
                'relatedid' => $this->relatedid
            ])];
        $view = [
            'id'=> $id,
            'info'=> $info,
            'fieldTypes'=> $this->hstcmsFields->type(),
            'navs'=>$this->getNavs('edit')
        ];
        return $this->loadTemplate('hstcms::manage.fields.edit', $view);
    }

    public function editSave(Request $request)
    {
        $id = $request->get('id');
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $info = CommonFieldsModel::getField($id);
        if(!$info) {
            return $this->showError('hstcms::public.no.data');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ],[
            'name.required'=>hst_lang('hstcms::manage.fields.name.empty')
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        if($this->rname == 'form') {
            $formInfo = CommonFormModel::getForm($this->relatedid);
            if(!$formInfo) {
                return $this->showError('hstcms::manage.form.no.info');
            }
            $relatedtable = $formInfo['table'];
        }
        $setting = $request->get('setting');
        $setting['validate']['isedit'] = (int)hst_switch($request->all(), 'isedit');
        $setting['option']['isfrontshow'] = (int)hst_switch($request->all(), 'isfrontshow');
        $psotData = [
            'name'=>$request->get('name'),
            'vieworder'=>(int)$request->get('vieworder'),
            'ismshow'=>(int)hst_switch($request->all(), 'ismshow'),
            'issearch'=>(int)hst_switch($request->all(), 'issearch'),
            'disabled'=>(int)hst_switch($request->all(), 'disabled', true),
            'setting'=>hst_array2str($setting)
        ];
        CommonFieldsModel::where('id', $id)->update($psotData);
        CommonFieldsModel::setCache('all');
        CommonFieldsModel::setCache($relatedtable);
        $this->addOperationLog(hst_lang('hstcms::manage.fields.edit').':'.$id, '', [
            'name'=>$request->get('name'),
            'vieworder'=>$request->get('vieworder'),
            'ismshow'=>(int)hst_switch($request->all(), 'ismshow'),
            'issearch'=>(int)hst_switch($request->all(), 'issearch'),
            'disabled'=>(int)hst_switch($request->all(), 'disabled', true)
        ], []);
        return $this->showMessage('hstcms::public.edit.success'); 
    }

    public function delete($id)
    {
        if(!$id) {
            return $this->showError('hstcms::public.no.id', 5);
        }
        $info = CommonFieldsModel::getField($id);
        if(!$info) {
            return $this->showError('hstcms::public.no.data', 5);
        }
        CommonFieldsModel::deleteField($id);
        CommonFieldsModel::setCache('all');
        CommonFieldsModel::setCache($info['relatedtable']);
        $this->addOperationLog(hst_lang('hstcms::manage.fields.delete').':'.$id, '', [], $info);
        return $this->showMessage('hstcms::public.delete.success', 5); 
    }

    public function cache() 
    {
        CommonFieldsModel::setCache('all');
        $this->addOperationLog(hst_lang('hstcms::manage.fields.cache'));
        return $this->showMessage('hstcms::public.successful', 5); 
    }
}

