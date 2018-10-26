<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Cache;

class BasicController extends GlobalBasicController
{

    public function __construct()
    {
        parent::__construct();
        hst_checkInstall();
        //前端多彩主题
        $skin_color = hst_config('site', 'skin_color');
        if($skin_color) {
            $this->viewData['skin_color'] = $skin_color;
        }
        $icp = hst_config('site', 'icp') ? '<a href="http://www.miibeian.gov.cn/" target="_blank">'.hst_config('site', 'icp').'</a>' : '';
        $this->viewData['icp'] = $icp;
        $this->middleware('check.site.status');
    }
}
