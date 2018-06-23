<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Model\CommonSmsModel;

use Huasituo\Hstcms\Libraries\HstcmsSmsApi;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class SmsController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
        $this->navs = [
            'index'=>['name'=>hst_lang('hstcms::manage.sms.platform'),'url'=>'manageSms'],
            'config'=>['name'=>hst_lang('hstcms::manage.sms.setting'),'url'=>'manageSmsConfig'],
            'log'=>['name'=>hst_lang('hstcms::manage.sms.send.log'),'url'=>'manageSmsLog'],
        ];
    }

    public function index(Request $request)
    {
    	$config = hst_config('sms');
        if(!isset($config['platform']) || !$config['platform']) {
            $config['platform'] = 'huasituo';
        }
        $platforms = CommonSmsModel::getPlatform();
        $this->viewData['navs'] = $this->getNavs('index');
    	return $this->loadTemplate('sms.index', ['config'=>$config, 'platforms'=>$platforms]);
    }

    public function save(Request $request)
    {
        $arrRequest = $request->all();
        $arrRequest['platform'] = $arrRequest['platform'] ? $arrRequest['platform'] : 'huasituo';
        $data =[
            ['name'=>'platform', 'value'=>trim($arrRequest['platform'])]
        ];
        $oldConfig = hst_config('sms');
        hst_save_config('sms', $data);
        $this->addOperationLog(hst_lang('hstcms::manage.sms.platform'),'', hst_config('sms'), $oldConfig);
        return $this->showMessage('hstcms::public.save.success');
    }

    public function config(Request $request)
    {
        $config = hst_config('sms');
        $this->viewData['navs'] = $this->getNavs('config');
        $types = CommonSmsModel::getType();
        return $this->loadTemplate('sms.config', ['config'=>$config, 'types'=>$types]);
    }

    public function configSave(Request $request) 
    {
        $arrRequest = $request->all();
        $types = CommonSmsModel::getType();
        $data = [];
        if($types){
            foreach ($types as $key => $value) {
                $data['types'][$key]['status'] = hst_switch($arrRequest, $key);
                $data['types'][$key]['content'] = $request->get('types')[$key]['content'];
            }
        }
        $postData =[
            ['name'=>'types', 'value'=>$data['types'], 'issystem'=>1],
            ['name'=>'codelength', 'value'=>$arrRequest['codelength'], 'issystem'=>1],
            ['name'=>'product', 'value'=>$arrRequest['product'], 'issystem'=>1]
        ];
        $oldConfig = hst_config('sms');
        hst_save_config('sms', $postData);
        $this->addOperationLog(hst_lang('hstcms::manage.sms.update'),'', hst_config('sms'), $oldConfig);
        return $this->showMessage('hstcms::public.save.success');
    }

    public function hstsmsConfig(Request $request)
    {
        $config = hst_config('sms');
        $this->navs = [
            'hstsmsConfig'=>['name'=>hst_lang('hstcms::manage.sms.setting'),'url'=>'manageSmsHstsmsConfig'],
            'payHstsms'=>['name'=>hst_lang('hstcms::manage.sms.purchase'),'url'=>'manageSmsHstsmsBuy'],
        ];
        $HstcmsSmsApi = new HstcmsSmsApi();
        $result = $HstcmsSmsApi->getSurplus();
        $this->viewData['navs'] = $this->getNavs('hstsmsConfig');
        return $this->loadTemplate('sms.hstsms', ['config'=>$config, 'surplus'=>$result]);
    }

    public function hstsmsConfigSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hstsmsappid' => 'required',
            'hstsmskey' => 'required',
            'hstsmssign' => 'required',
        ],[
            'hstsmsappid.required'=>hst_lang('hstcms::manage.sms.hstsmsappid.empty'),
            'hstsmskey.required'=>hst_lang('hstcms::manage.sms.hstsmskey.empty'),
            'hstsmssign.required'=>hst_lang('hstcms::manage.sms.hstsmssign.empty'),
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $arrRequest = $request->all();
        $data =[
            ['name'=>'hstsmsappid', 'value'=>trim($arrRequest['hstsmsappid'])],
            ['name'=>'hstsmskey', 'value'=>trim($arrRequest['hstsmskey'])],
            ['name'=>'hstsmssign', 'value'=>trim($arrRequest['hstsmssign'])],
        ];
        $oldConfig = hst_config('sms');
        hst_save_config('sms', $data);
        $this->addOperationLog(hst_lang('hstcms::manage.sms.hstsms.seeting'),'', hst_config('sms'), $oldConfig);
        return $this->showMessage('hstcms::public.save.success');

    }

    public function hstsmsBuy(Request $request) 
    {
        $config = hst_config('sms');
        $this->navs = [
            'hstsmsConfig'=>['name'=>hst_lang('hstcms::manage.sms.setting'),'url'=>'manageSmsHstsmsConfig'],
            'payHstsms'=>['name'=>hst_lang('hstcms::manage.sms.purchase'),'url'=>'manageSmsHstsmsBuy'],
        ];
        $HstcmsSmsApi = new HstcmsSmsApi();
        $result = $HstcmsSmsApi->getSurplus();

        $this->viewData['navs'] = $this->getNavs('payHstsms');
        return $this->loadTemplate('sms.hstsms_buy', ['config'=>$config, 'surplus'=>$result]);
    }

    public function hstsmsBuys(Request $request) 
    {
        $HstcmsSmsApi = new HstcmsSmsApi();
        $result = $HstcmsSmsApi->getPay($request->get('money'));
        return redirect($result);
    }

    public function log(Request $request)
    {
        $type = $request->input('type');
        $status = $request->input('status');
        $uid = $request->input('uid');
        $mobile = $request->input('mobile');
        $stime = $request->input('stime');
        $etime = $request->input('etime');
        $listQuery = CommonSmsModel::where('id', '>', 0);
        $args = ['status'=>0, 'type'=>''];
        if($uid) {
            $args['uid'] = $uid;
            $listQuery->where('uid', $uid);
        }
        if($mobile) {
            $args['mobile'] = $mobile;
            $listQuery->where('mobile', $mobile);
        }
        if($type) {
            $args['type'] = $type;
            $listQuery->where('type', $type);
        }
        if($status) {
            $args['status'] = $status;
            if ($status == 9) {
                $status = 0;
            }
            $listQuery->where('status', $status);
        }
        if($stime) {
            $args['stime'] = $stime;
            $stime = hst_str2time($stime);
            $listQuery->where('times', '>=', $stime);
        }
        if($etime) {
            $args['etime'] = $etime;
            $etime = hst_str2time($etime);
            $listQuery->where('times', '<=', $etime);
        }
        $list = $listQuery->orderby('times', 'desc')->paginate($this->paginate);
        $this->viewData['navs'] = $this->getNavs('log');
        $types = CommonSmsModel::getType();
        $view = [
            'list'=>$list,
            'args'=>$args,
            'types'=>$types
        ];
        return $this->loadTemplate('hstcms::manage.sms.log', $view);
    }

    public function logView($id, Request $request) 
    {
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $info = CommonSmsModel::where('id', $id)->first();
        if(!$info) {
            return $this->showError('hstcms::public.no.data');
        }
        $this->navs['view'] = ['name'=>hst_lang('hstsms::public.log.view'), 'url'=>route('manageHstsmsLogNoticesView', ['id'=>$id])];
        $this->viewData['navs'] = $this->getNavs('view');
        $view = [
            'info'=>$info
        ];
        return $this->loadTemplate('hstcms::manage.sms.log_view', $view);
    }
}

