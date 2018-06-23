<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers;

use Huasituo\Hstcms\Http\Controllers\GlobalBasicController as BaseController;

use Gregwar\Captcha\CaptchaBuilder;

use Illuminate\Http\Request;


class CaptchaController extends BaseController
{

    public function get(Request $request) 
    {
    	$w = (int)$request->get('w');
        $h = (int)$request->get('h');
    	$l = (int)$request->get('l');
    	$width = $w ? $w : config('hstcms.captcha.width');
        $height = $h ? $h : config('hstcms.captcha.height');
    	$length = $l ? $l : config('hstcms.captcha.length');
        $str = hst_random($length);
        $builder = new CaptchaBuilder($str);
		$builder->build($width, $height);
		$_SESSION['phrase'] = $builder->getPhrase();
		header('Content-type: image/jpeg');
		$builder->output();
		exit;
    }
}