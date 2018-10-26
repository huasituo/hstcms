<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
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
        if($arrRequest['driver'] == 'redis') {
            if(!isset($oldConfig['redishost']) || !$oldConfig['redishost']) {
                return $this->showError('hstcms::manage.caches.save.error.002', 5);
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

    public function redisConfig(Request $request)
    {
        $config = hst_config('caches');
        $this->navs['redis'] = ['name'=>hst_lang('hstcms::manage.caches.redis.setting'),'url'=>'manageCachesRedisConfig'];
        $this->viewData['navs'] = $this->getNavs('redis');
        return $this->loadTemplate('caches.redis', ['config'=>$config]);
    }

    public function redisConfigSave(Request $request) 
    {
        $arrRequest = $request->all();
        $postData =[
            ['name'=>'redishost', 'value'=>$arrRequest['host'], 'issystem'=>1],
            ['name'=>'redisport', 'value'=>$arrRequest['port'], 'issystem'=>1],
            ['name'=>'redispassword', 'value'=>$arrRequest['password'], 'issystem'=>1]
        ];
        $oldConfig = hst_config('caches');
        hst_save_config('caches', $postData);
        $configData = [
            'REDIS_PASSWORD'=>$arrRequest['password'],
            'REDIS_HOST'=>$arrRequest['host'],
            'REDIS_PORT'=>$arrRequest['port']
        ];
        hst_updateEnvInfo($configData);
        $this->addOperationLog(hst_lang('hstcms::manage.caches.redis.update'),'', hst_config('sms'), $oldConfig);
        return $this->showMessage('hstcms::public.save.success');
    }
}

