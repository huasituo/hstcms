<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Requests;

class SafeController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
    	$config = hst_config('safe');
    	return $this->loadTemplate('safe.index', ['config'=>$config]);
    }

    public function save(Request $request)
    {
    	$arrRequest = $request->all();
    	$data =[
    		['name'=>'manage.request', 'value'=>hst_switch($arrRequest, 'request'), 'issystem'=>1],
    		['name'=>'manage.operation', 'value'=>hst_switch($arrRequest, 'operation'), 'issystem'=>1],
    		['name'=>'manage.login.ips', 'value'=>$arrRequest['safeIps'], 'issystem'=>1],
            ['name'=>'manage.login.ctime', 'value'=>$arrRequest['loginCtime'], 'issystem'=>1],
    	];
        $oldConfig = hst_config('safe');
    	hst_save_config('safe', $data);
        $this->addOperationLog(hst_lang('hstcms::manage.safe.update'),'', hst_config('safe'), $oldConfig);
        return $this->showMessage('hstcms::public.save.success');
    }
}

