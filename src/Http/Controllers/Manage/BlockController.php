<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Model\CommonBlockModel;
use Huasituo\Hstcms\Model\AttachmentModel;

use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;

class BlockController extends BasicController
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
            'index'=>['name'=>hst_lang('hstcms::manage.block'), 'url'=>route('manageBlockIndex', ['module'=>$this->module])],
            'add'=>['name'=>hst_lang('hstcms::public.add'), 'url'=>route('manageBlockAdd', ['module'=>$this->module]), 'class'=>'J_dialog', 'title'=>hst_lang('hstcms::manage.special.add')],
            'cache'=>['name'=>hst_lang('hstcms::public.update.cache'), 'class'=>'J_ajax_refresh', 'url'=>route('manageSpecialCache', ['module'=>$this->module])]
        ];
        $this->viewData['module'] = $this->module;
    }

    public function index(Request $request)
    {
        $listQuery = CommonBlockModel::where('id', '>', 0);
        $args = [];
        $list = $listQuery->orderby('times', 'desc')->paginate($this->paginate);
        $view = [
            'list'=>$list,
            'args'=>$args,
            'navs'=>$this->getNavs('index')
        ];
    	return $this->loadTemplate('hstcms::manage.block.index', $view);
    }

    public function add(Request $request)
    {
        return $this->loadTemplate('hstcms::manage.block.add', [
        ]);
    }

    public function addSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required'
        ],[
            'name.required'=>hst_lang('hstcms::manage.block.name.empty'),
            'type.required'=>hst_lang('hstcms::manage.type.empty')
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $content = $request->get('content');
        $type = $request->get('type');
        $image = $request->get('image');
        $link = $request->get('link');
        $contents = [
            'image'=>$image ? $image['aid'] : 0,
            'link'=>$link
        ];
        if($type == 'image') {
            $content = serialize($contents);
        }
        if($type == 'html') {
            $content = $request->get('contentv');
        }
        $psotData = [
            'name'=>$request->get('name'),
            'type'=>$type,
            'content'=>$content,
            'isopen'=>(int)hst_switch($request->all(), 'isopen'),
            'times'=>hst_time()
        ];
        $id = CommonBlockModel::insertGetId($psotData);
        if(!$id) {
            return $this->showError('hstcms::public.error');
        }
        if($contents['image']) {
            AttachmentModel::updateAttach($contents['image'], $id);
        }
        CommonBlockModel::setCache($id);
        $this->addOperationLog(hst_lang('hstcms::public.add','hstcms::public.block').':'.trim($request->get('name')), '', $psotData, []);
        return $this->showMessage('hstcms::public.add.success'); 
    }

    public function edit($id, Request $request)
    {
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $info = CommonBlockModel::getInfo($id);
        if(!$info) {
            return $this->showError('hstcms::public.no.data');
        }
        $view = [
            'id'=> $id,
            'info'=> $info,
        ];
        return $this->loadTemplate('hstcms::manage.block.edit', $view);
    }

    public function editSave(Request $request)
    {
        $id = $request->get('id');
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $info = CommonBlockModel::getInfo($id);
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
        $content = $request->get('content');
        $type = $request->get('type');
        $image = $request->get('image');
        $link = $request->get('link');
        $contents = [
            'image'=>isset($image['aid']) && $image['aid'] ? $image['aid'] : 0,
            'link'=>$link
        ];
        if($type == 'image') {
            $content = serialize($contents);
        }
        if($type == 'html') {
            $content = $request->get('contentv');
        }
        $psotData = [
            'name'=>$request->get('name'),
            'type'=>$type,
            'content'=>$content,
            'isopen'=>(int)hst_switch($request->all(), 'isopen'),
            'times'=>hst_time()
        ];
        CommonBlockModel::where('id', $id)->update($psotData);
        if($contents['image']) {
            AttachmentModel::updateAttach($contents['image'], $id);
        }
        CommonBlockModel::setCache($id);
        $this->addOperationLog(hst_lang('hstcms::manage.edit').':'.$id, '', $psotData, $info);
        return $this->showMessage('hstcms::public.edit.success'); 
    }

    public function delete($id, Request $request)
    {
        if(!$id) {
            return $this->showError('hstcms::public.no.id', 5);
        }
        $info = CommonBlockModel::getCache($id);
        if(!$info) {
            return $this->showError('hstcms::public.no.data', 5);
        }
        CommonBlockModel::deleteBlock($id);
        AttachmentModel::deleteAttachByAppId('block', $info['id']);
        $this->addOperationLog(hst_lang('hstcms::public.delete').':'.$id, '', [], $info);
        return $this->showMessage('hstcms::public.delete.success', 5); 
    }

    public function cache() 
    {
        CommonBlockModel::setCache(0);
        $this->addOperationLog(hst_lang('hstcms::public.cache'));
        return $this->showMessage('hstcms::public.successful', 5); 
    }

}

