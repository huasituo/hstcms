<?php 

namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Model\AttachmentModel;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class ApiController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
        $this->navs = [
            'index'=>['name'=>hst_lang('hstcms::manage.api.setting'),'url'=>'manageApi'],
        ];
    }

    public function index(Request $request)
    {
    	$config = hst_config('api');
        $this->viewData['navs'] = $this->getNavs('index');
    	return $this->loadTemplate('api.index', [
            'config'=>$config
        ]);
    }

    public function save(Request $request)
    {
        $arrRequest = $request->all();
        $arrRequest['key'] = $arrRequest['key'] ? $arrRequest['key'] : '';
        $data =[
            ['name'=>'key', 'value'=>$arrRequest['key'], 'issystem'=>1],
        ];
        $oldConfig = hst_config('api');
        hst_save_config('api', $data);
        $this->addOperationLog(hst_lang('hstcms::manage.api.setting'),'', hst_config('api'), $oldConfig);
        return $this->showMessage('hstcms::public.save.success');
    }

}
