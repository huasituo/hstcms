<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Model\ManageModulesModel;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Module;

class ModulesController extends BasicController
{
    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
        $this->navs = [
            'index'=>['name'=>hst_lang('hstcms::manage.modules.manage'), 'url'=>'manageModules'],
            'uninstalls'=>['name'=>hst_lang('hstcms::manage.modules.uninstalls'), 'url'=>'manageModulesUninstalls'],
        ];
    }

    public function index(Request $request)
    {
        $list = ManageModulesModel::getData();
        $view = [
            'list'=>$list,
            'navs'=>$this->getNavs('index')
        ];
    	return $this->loadTemplate('modules.index', $view);
    }

    public function enableds(Request $request) 
    {
        $slug = $request->get('slug');
        $enableds = $request->get('enableds');
        if(!$slug) {
            return $this->showError(hst_lang('hstcms::manage.modules.no.ext'), 2);
        }
        $module = $this->getLocalModules($slug);
        if(!$module) {
            return $this->showError(hst_lang('hstcms::manage.modules.no.ext'), 2);
        }
        $moduleInfo = ManageModulesModel::where('slug', $slug)->first();
        if(!$moduleInfo) {
            return $this->showError(hst_lang('hstcms::manage.modules.no.ext'), 2);
        }
        $moduleInstallLog = Module::where('slug', $slug);
        if(!$moduleInstallLog) {
            return $this->showError(hst_lang('hstcms::manage.modules.no.ext'), 2);
        }
        $postData = [
            'enabled'=>$enableds
        ];
        ManageModulesModel::where('slug', $slug)->update($postData);
        if($enableds == 1){
            Module::enable($slug);
        } else {
            Module::disable($slug);
        }
        ManageModulesModel::setCache();
        return $this->showMessage('hstcms::public.success', 2);
    }

    public function douninstall(Request $request) 
    {   
        $slug = $request->get('slug');
        if(!$slug) {
            return $this->showError(hst_lang('hstcms::manage.modules.no.ext'));
        }
        $module = $this->getLocalModules($slug);
        if(!$module) {
            return $this->showError(hst_lang('hstcms::manage.modules.no.ext'));
        }
        $moduleInfo = ManageModulesModel::where('slug', $slug)->first();
        if(!$moduleInfo) {
            return $this->showError(hst_lang('hstcms::manage.modules.no.ext'));
        }
        $moduleInstallLog = Module::where('slug', $slug);
        if(!$moduleInstallLog) {
            return $this->showError(hst_lang('hstcms::manage.modules.no.ext'));
        }
        Module::disable($slug);
        ManageModulesModel::where('slug', $slug)->delete();
        Artisan::call('module:migrate:rollback', [
            'slug'=>$slug
        ]);
        Artisan::call('hook:cache', [
            '--p'=>'Modules/'.ucfirst($slug),
            '--f'=>'app',
            '--t'=>'delete'
        ]);
        ManageModulesModel::setCache();
        return $this->showMessage('hstcms::public.success');
    }

    public function uninstalls(Request $request) 
    {
        $list = $this->getLocalModules();
        foreach ($list as $key => $value) {
            if(ManageModulesModel::where('slug', $value['slug'])->count() && Module::where('slug', $value['slug'])) {
                unset($list[$key]);
            }
        }
        $view = [
            'list'=>$list,
            'navs'=>$this->getNavs('uninstalls')
        ];
        return $this->loadTemplate('modules.uninstalls', $view);
    }

    public function doinstalls(Request $request) 
    {
        $slug = $request->get('slug');
        if(!$slug) {
            return $this->showError(hst_lang('hstcms::manage.modules.no.ext'), 2);
        }
        $module = $this->getLocalModules($slug);
        if(!$module) {
            return $this->showError(hst_lang('hstcms::manage.modules.no.ext'), 2);
        }
        $moduleInfo = ManageModulesModel::where('slug', $slug)->first();
        $moduleInstallLog = Module::where('slug', $slug)->toArray();
        if($moduleInfo && $moduleInstallLog) {
            return $this->showError(hst_lang('hstcms::manage.modules.install.donet'), 2);
        }
        $postData = [
            'name'=>$module['name'],
            'slug'=>$module['slug'],
            'description'=>$module['description'],
            'times'=>hst_time(),
            'version'=>$module['version'],
            'enabled'=>1,
        ];
        if(!$moduleInfo) {
            ManageModulesModel::insertGetId($postData);
        } else {
            ManageModulesModel::where('slug', $slug)->update($postData);
        }
        if(!$moduleInstallLog) {
            Artisan::call('module:optimize');
            Artisan::call('module:migrate', [
                'slug'=>$slug
            ]);
            Artisan::call('module:seed', [
                'slug'=>$slug
            ]);
        } else {
            $enabled = 1;
            ManageModulesModel::where('slug', $slug)->update(['enabled'=>$enabled]);
            Module::enable($slug);
            Artisan::call('module:migrate:refresh', [
                'slug'=>$slug,
                '--pretend'=>true
            ]);
            Artisan::call('module:migrate:refresh', [
                'slug'=>$slug,
                '--seed'=>true
            ]);
        }
        Artisan::call('hook:cache', [
            '--p'=>'Modules/'.ucfirst($slug),
            '--f'=>'app'
        ]);
        ManageModulesModel::setCache();
        return $this->showMessage('hstcms::public.install.success',2);
    }

    public function cache(Request $request) 
    {
        ManageModulesModel::setCache();
        return $this->showMessage('hstcms::public.install.success',2);
    }

    public function getLocalModules($slug = '') 
    {
        $path    = app_path('Modules');
        $modules = $this->files->glob($path.'/*/module.json');
        $list = [];
        foreach ($modules as $module) {
            $moduleJson = json_decode($this->files->get($module), true);
            $list[$moduleJson['slug']] = $moduleJson;
        }
        if($slug) {
            return isset($list[$slug]) ? $list[$slug] : [];
        }
        return $list;
    }
}

