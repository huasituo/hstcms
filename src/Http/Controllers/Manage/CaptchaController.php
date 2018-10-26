<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class CaptchaController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
    	return $this->loadTemplate('hstcms::manage.captcha.index', [
            'config'=>hst_config('captcha')
        ]);
    }

    public function save(Request $request) 
    {
        $arrRequest = $request->all();
        $arrRequest['width'] = $arrRequest['width'] ? $arrRequest['width'] : 120;
        $arrRequest['height'] = $arrRequest['height'] ? $arrRequest['height'] : 60;
        $arrRequest['length'] = $arrRequest['length'] ? $arrRequest['length'] : 5;
        $data =[
            ['name'=>'width', 'value'=>$arrRequest['width']],
            ['name'=>'height', 'value'=>$arrRequest['height']],
            ['name'=>'length', 'value'=>$arrRequest['length']],
        ];
        $configData = [
            'CAPTCHA_WIDTH' => $arrRequest['width'] ? (int)$arrRequest['width'] : 120,
            'CAPTCHA_HEIGHT' => $arrRequest['height'] ? (int)$arrRequest['height'] : 60,
            'CAPTCHA_LENGTH' => $arrRequest['length'] ? (int)$arrRequest['length'] : 5,
        ];
        $oldConfig = hst_config('captcha');
        hst_save_config('captcha', $data);
        hst_updateEnvInfo($configData);
        $this->addOperationLog(hst_lang('hstcms::captcha.svae'),'', hst_config('captcha'), $oldConfig);
        return $this->showMessage('hstcms::public.save.success');
    }
}

