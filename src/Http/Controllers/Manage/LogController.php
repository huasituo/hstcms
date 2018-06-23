<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Model\ManageLoginLogModel;
use Huasituo\Hstcms\Model\ManageOperationLogModel;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Http\Requests;

class LogController extends BasicController
{

    public function __construct()
    {
        parent::__construct();
        $this->navs = [
            'request'=>['name'=>hst_lang('hstcms::manage.request.log'),'url'=>'manageLogRequest'],
            'operation'=>['name'=>hst_lang('hstcms::manage.operation.log'),'url'=>'manageLogOperation'],
            'login'=>['name'=>hst_lang('hstcms::manage.login.log'),'url'=>'manageLogLogin'],
        ];
    }

    public function logRequest(Request $request)
    {
        if($request->get('_ajax')){
            $data = $list = $args = array();
            $time = $request->get('time');
            $uri = $request->get('uri');
            $ip = $request->get('ip');
            $username = $request->get('username');
            $args['time'] = $time ? $time : hst_getTdtime();
            $times = hst_str2time($time);
            $times = $times ? $times : hst_time();
            $file = base_path('storage/hstcms/requestlog/'. hst_time2str($times, 'Ym') . '/'.hst_time2str($times, 'd').'.log');
            $file = @file_get_contents($file);
            $page = max(1, (int)$request->get('page'));
            $perPage = $this->paginate;
            if($file) {
                $data = @explode(PHP_EOL, $file);
                $data = explode(PHP_EOL, $file);
                $data = $data ? array_reverse($data) : array();
                unset($data[0]);
                foreach ($data as $k => $v)  {
                    $data[$k] = unserialize($v);
                    if($username && $data[$k]['username'] != $username) {
                        unset($data[$k]);
                    }
                    if($ip && $data[$k]['ip'] != $ip) {
                        unset($data[$k]);
                    }
                    if($uri && $data[$k]['uri'] != $uri) {
                        unset($data[$k]);
                    }
                    if(isset($data[$k])){
                        $data[$k]['_data'] = json_encode($data[$k]['data']);
                        $data[$k]['times'] = hst_time2str($data[$k]['times'], 'Y-m-d H:i:s');
                    }
                }
            }
            $total = count($data);
            $item = array_slice($data, ($page-1)*$perPage, $perPage);
            $paginator =new LengthAwarePaginator($item, $total, $perPage, $page, ['pageName'=>'page']);
            $paginator->setPath('request')->appends($args);
            $list = $paginator->toArray()['data'];
            $this->addMessage($paginator, 'list');
            return $this->showMessage('Hstcms::public.successful');
        }
        $this->viewData['navs'] = $this->getNavs('request');
    	return $this->loadTemplate('log.request');
    }

    public function logOperation(Request $request)
    {
        if($request->get('_ajax')) {
            $ip = $request->input('ip');
            $stime = $request->input('stime');
            $etime = $request->input('etime');
            $username = $request->input('username');
            $OperationLog = ManageOperationLogModel::where('id', '>', 0);
            if($ip) {
                $OperationLog->where('ip', $ip);
            }
            if($username) {
                $OperationLog->where('username', $username);
            }
            if($stime) {
                $stime = hst_str2time($stime);
                $OperationLog->where('times', '>=', $stime);
            }
            if($etime) {
                $etime = hst_str2time($etime);
                $OperationLog->where('times', '<=', $etime);
            }
            $list = $OperationLog->orderby('times', 'desc')->paginate($this->paginate);
            foreach ($list as $key => $value) {
                $list[$key]['times'] = hst_time2str($value['times'], 'Y-m-d H:i:s');
                $list[$key]['viewurl'] = route('manageLogOperationView', ['id'=>$value['id']]);
            }
            $this->addMessage($list, 'list');
            return $this->showMessage('Hstcms::public.successful');
        }
        $view = [
            'navs'=>$this->getNavs('operation')
        ];
        return $this->loadTemplate('log.operation', $view);
    }

    public function logOperationView($id)
    {
        if(!$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $info = ManageOperationLogModel::where('id', $id)->first();
        if(!$info) {
            return $this->showError('hstcms::public.no.data');
        }
        $info['olddata'] = unserialize($info['olddata']);
        $info['newdata'] = unserialize($info['newdata']);
        if(!$info['status']) {
            $editData = [
                'status'=>1,
                'suid'=>hst_manager('uid'),
                'susername'=> hst_manager('username'),
                'stimes'=> hst_time()
            ];
            ManageOperationLogModel::where('id', $id)->update($editData);
        }
        $view = [
            'info'=>$info
        ];
        return $this->loadTemplate('log.operation_view', $view);
    }

    public function logLogin(Request $request)
    {
        if($request->get('_ajax')){
            $ip = $request->input('ip');
            $username = $request->input('username');
            $stime = $request->input('stime');
            $etime = $request->input('etime');
            $LoginLog = ManageLoginLogModel::where('id', '>', 0);
            if($ip) {
                $LoginLog->where('ip', $ip);
            }
            if($username) {
                $LoginLog->where('username', $username);
            }
            if($stime) {
                $stime = hst_str2time($stime);
                $LoginLog->where('times', '>=', $stime);
            }
            if($etime) {
                $etime = hst_str2time($etime);
                $LoginLog->where('times', '<=', $etime);
            }
            $list = $LoginLog->orderby('times', 'desc')->paginate($this->paginate);
            foreach ($list as $key => $value) {
                $list[$key]['times'] = hst_time2str($value['times'], 'Y-m-d H:i:s');
            }
            $this->addMessage($list, 'list');
            return $this->showMessage('Hstcms::public.successful');
        }
        $this->viewData['navs'] = $this->getNavs('login');
        return $this->loadTemplate('log.login');
    }
}

