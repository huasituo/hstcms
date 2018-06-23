<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers;

use Huasituo\Hstcms\Model\CommonSpecialModel;
use Illuminate\Http\Request;
/**
* 
*/
class SpecialController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function view($v, Request $request) 
    {
        if(!$v) {
            return $this->showError('hstcms::public.no.data', env('APP_URL'));
        }
        if(!is_numeric($v)) {
            $v = CommonSpecialModel::getIdByDir($v);
        }
        $info = CommonSpecialModel::getInfo($v);
        if(!$info) {
            return $this->showError('hstcms::public.no.data', env('APP_URL'));
        }
        $view = [
            'info'=>$info
        ];
        if($info['style']) {
            if($info['module'] == 'site') {
                return $this->loadTemplate($info['style'], $view);
            }
            return $this->loadTemplate($info['module'].'::'.$info['style'], $view);
        }
        $view['css'] = url('theme/special/'.$v.'/css');
        $view['images'] = url('theme/special/'.$v.'/images');
        $view['js'] = url('theme/special/'.$v.'/js');
        return $this->loadTemplate('special::'.$v.'.index', $view);
    }
    
}