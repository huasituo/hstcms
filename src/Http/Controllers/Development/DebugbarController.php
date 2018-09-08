<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Development;

use Huasituo\Hstcms\Http\Controllers\GlobalBasicController as BaseController;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Cache;

class DebugbarController extends BaseController
{

	public function index(Request $request)
	{
		$this->editContent();
		$view = [
			'seo_title'=>'开发调试中心'
		];
		return $this->loadTemplate('hstcms::development.debugbar_index', $view);
	}

	public function editContent()
	{
        $cacheName = 'development:debugbar';
        if (!Cache::has($cacheName)) {
        	$files = new Filesystem();
        	$path = realpath(__DIR__.'/../../../../../../barryvdh/laravel-debugbar/src/LaravelDebugbar.php');
        	$content = $files->get($path);
        	$content = str_replace("use Symfony\Component\HttpFoundation\Response;","use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;//20180907 by huasituo.com",$content);
        	$content = str_replace('$renderedContent = $renderer->renderHead() . $renderer->render();','$renderedContent = $renderer->renderHead() . $renderer->render();
        if(Route::currentRouteName() != \'developmentDebugbarIndex\') $renderedContent = \'\';//20180907 by huasituo.com',$content);
        	$files->put($path, $content);
        	Cache::forever($cacheName, 1);
        }
	}

	public function deleteContent()
	{
        $cacheName = 'development:debugbar';
        $files = new Filesystem();
        $path = realpath(__DIR__.'/../../../../../../barryvdh/laravel-debugbar/src/LaravelDebugbar.php');
        $content = $files->get($path);
        $content = str_replace("use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;//20180907 by huasituo.com","use Symfony\Component\HttpFoundation\Response;",$content);
        $content = str_replace('$renderedContent = $renderer->renderHead() . $renderer->render();
        if(Route::currentRouteName() != \'developmentDebugbarIndex\') $renderedContent = \'\';//20180907 by huasituo.com','$renderedContent = $renderer->renderHead() . $renderer->render();',$content);
        $files->put($path, $content);
        Cache::forever($cacheName, 0);
        Cache::forget($cacheName);
	}
}