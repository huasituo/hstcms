<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Model\CommonAreaModel;

use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;

class AreaController extends BasicController
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
            'index'=>['name'=>hst_lang('hstcms::manage.area.manage'), 'url'=>route('manageAreaIndex')]
        ];
        $this->viewData['module'] = $this->module;
    }

    public function index(Request $request)
    {
        $areaid = (int)$request->get('areaid');
        $areaInfo = [];
        if($areaid) {
            $areaInfo = CommonAreaModel::getInfoByAreaid($areaid);
            if($areaInfo) {
                foreach ($areaInfo['joinids'] as $key => $value) {
                    $this->navs['index'.$value] = ['name'=>$areaInfo['joinnames'][$key], 'url'=>route('manageAreaIndex', ['areaid'=>$value])];
                }
            }
        }
        $this->navs['add'] = ['name'=>hst_lang('hstcms::public.add'), 'url'=>route('manageAreaAdd', ['areaid'=>$areaid]), 'class'=>'J_dialog', 'title'=>hst_lang('hstcms::public.add')];
        $list = CommonAreaModel::getSubByAreaid($areaid);
        $view = [
            'list'=>$list,
            'navs'=>$this->getNavs('index'.($areaid ? $areaid : ''))
        ];
    	return $this->loadTemplate('hstcms::manage.area.index', $view);
    }

    public function add(Request $request)
    {
        $view = [
            'areaid'=>$request->get('areaid')
        ];
        return $this->loadTemplate('hstcms::manage.area.add', $view);
    }

    public function addSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'areaid' => 'required',
            'name' => 'required'
        ],[
            'areaid.required'=>hst_lang('hstcms::manage.area.areaid.empty'),
            'name.required'=>hst_lang('hstcms::manage.area.name.empty')
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $parentid = $request->get('parentid');
        $areaid = $request->get('areaid');
        $info = CommonAreaModel::getInfoByAreaid($areaid);
        if($info) {
            return $this->showError('hstcms::manage.area.areaid.one');
        }
        $pinfo = CommonAreaModel::getInfoByAreaid($parentid);
        $psotData = [
            'name'=>$request->get('name'),
            'areaid'=>$request->get('areaid'),
            'parentid'=>$request->get('parentid'),
            'zip'=>(int)$request->get('zip'),
            'vieworder'=>0,
            'joinname'=>$pinfo['joinname'] . '|' . $request->get('name'),
            'initials'=>hst_word2pinyin($request->get('name'), false, true, false, true)
        ];
        CommonAreaModel::updateData($areaid, $psotData);
        $this->addOperationLog(hst_lang('hstcms::manage.area.add').':'.trim($request->get('name')), '', $psotData, []);
        return $this->showMessage('hstcms::public.add.success'); 
    }

    public function edit($areaid, Request $request)
    {
        if(!$areaid) {
            return $this->showError('hstcms::public.no.id');
        }
        $info = CommonAreaModel::where('areaid', $areaid)->first();
        if(!$info) {
            return $this->showError('hstcms::public.no.data');
        }
        $view = [
            'areaid'=> $areaid,
            'info'=> $info,
        ];
        return $this->loadTemplate('hstcms::manage.area.edit', $view);
    }

    public function editSave(Request $request)
    {
        $areaid = $request->get('areaid');
        if(!$areaid) {
            return $this->showError('hstcms::public.no.id');
        }
        $info = CommonAreaModel::where('areaid', $areaid)->first();
        if(!$info) {
            return $this->showError('hstcms::public.no.data');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ],[
            'name.required'=>hst_lang('hstcms::manage.area.name.empty')
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $psotData = [
            'name'=>$request->get('name'),
            'zip'=>(int)$request->get('zip'),
            'initials'=>hst_word2pinyin($request->get('name'), false, true, false, true)
        ];
        CommonAreaModel::where('areaid', $areaid)->update($psotData);
        $this->addOperationLog(hst_lang('hstcms::manage.area.edit').':'.$areaid, '', $psotData, $info);
        return $this->showMessage('hstcms::public.edit.success'); 
    }

    public function delete($areaid, Request $request)
    {
        if(!$areaid) {
            return $this->showError('hstcms::public.no.id', 5);
        }
        $info = CommonAreaModel::getInfoByAreaid($areaid, true);
        if(!$info) {
            return $this->showError('hstcms::public.no.data', 5);
        }
        if($info['sublist']) {
            return $this->showError('hstcms::manage.area.delete.001', 5);
        }
        unset($info['sublist']);
        CommonAreaModel::where('areaid', $areaid)->delete();
        $this->addOperationLog(hst_lang('hstcms::manage.area.delete').':'.$info['name'], '', [], $info);
        return $this->showMessage('hstcms::public.delete.success', 5); 
    }
}

