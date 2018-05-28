<?php 

namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;

class CachesController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
        $this->navs = [
            'index'=>['name'=>hst_lang('hstcms::manage.caches.setting'),'url'=>'manageCaches']
        ];
    }

    public function index(Request $request)
    {
    	$config = hst_config('caches');
        if(!isset($config['driver']) || !$config['driver']) {
            $config['driver'] = 'file';
        }
        $this->viewData['navs'] = $this->getNavs('index');
    	return $this->loadTemplate('caches.index', ['config'=>$config]);
    }

    public function save(Request $request)
    {
        $arrRequest = $request->all();
        $oldConfig = hst_config('caches');
        $arrRequest['driver'] = $arrRequest['driver'] ? $arrRequest['driver'] : 'file';
        if($arrRequest['driver'] == 'memcached') {
            if(!isset($oldConfig['memdusername']) || !$oldConfig['memdusername']) {
                return $this->showError('hstcms::manage.caches.save.error.001', 5);
            }
        }
        $data =[
            ['name'=>'driver', 'value'=>trim($arrRequest['driver'])]
        ];
        hst_save_config('caches', $data);
        $configData = [
            'CACHE_DRIVER'=>$arrRequest['driver']
        ];
        hst_updateEnvInfo($configData);
        $this->addOperationLog(hst_lang('hstcms::manage.caches.driver'),'', hst_config('caches'), $oldConfig);
        return $this->showMessage('hstcms::public.save.success', 5);
    }

    public function memcachedConfig(Request $request)
    {
        $config = hst_config('caches');
        $this->navs['memcached'] = ['name'=>hst_lang('hstcms::manage.caches.memcached.setting'),'url'=>'manageCachesMemcachedConfig'];
        $this->viewData['navs'] = $this->getNavs('memcached');
        return $this->loadTemplate('caches.memcached', ['config'=>$config]);
    }

    public function memcachedConfigSave(Request $request) 
    {
        $arrRequest = $request->all();
        $postData =[
            ['name'=>'memdpsid', 'value'=>$arrRequest['memdpsid'], 'issystem'=>1],
            ['name'=>'memdhost', 'value'=>$arrRequest['memdhost'], 'issystem'=>1],
            ['name'=>'memdport', 'value'=>$arrRequest['memdport'], 'issystem'=>1],
            ['name'=>'memdusername', 'value'=>$arrRequest['memdusername'], 'issystem'=>1],
            ['name'=>'memdpassword', 'value'=>$arrRequest['memdpassword'], 'issystem'=>1]
        ];
        $oldConfig = hst_config('caches');
        hst_save_config('caches', $postData);
        $configData = [
            'MEMCACHED_PERSISTENT_ID'=>$arrRequest['memdpsid'],
            'MEMCACHED_USERNAME'=>$arrRequest['memdusername'],
            'MEMCACHED_PASSWORD'=>$arrRequest['memdpassword'],
            'MEMCACHED_HOST'=>$arrRequest['memdhost'],
            'MEMCACHED_PORT'=>$arrRequest['memdport']
        ];
        hst_updateEnvInfo($configData);
        $this->addOperationLog(hst_lang('hstcms::manage.caches.memcached.update'),'', hst_config('sms'), $oldConfig);
        return $this->showMessage('hstcms::public.save.success');
    }
}

