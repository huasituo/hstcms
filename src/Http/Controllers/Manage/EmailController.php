<?php 

namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class EmailController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
        $this->navs = [
            'index'=>['name'=>hst_lang('hstcms::manage.email.config'),'url'=>'manageConfigEmailIndex'],
            'test'=>['name'=>hst_lang('hstcms::manage.email.test'),'url'=>'manageConfigEmailTest'],
        ];
    }

    public function index(Request $request)
    {
    	$config = hst_config('email');
        $this->viewData['navs'] = $this->getNavs('index');
    	return $this->loadTemplate('email.index', ['config'=>$config]);
    }

    public function save(Request $request)
    {
    	$arrRequest = $request->all();
    	$data =[
            ['name'=>'host', 'value'=>$arrRequest['host']],
            ['name'=>'port', 'value'=>$arrRequest['port']],
            ['name'=>'from', 'value'=>$arrRequest['from']],
            ['name'=>'from.name', 'value'=>$arrRequest['fromName']],
    		['name'=>'auth', 'value'=>hst_switch($arrRequest, 'auth')],
    		['name'=>'user', 'value'=>$arrRequest['user']],
            ['name'=>'password', 'value'=>$arrRequest['password']],
    	];
        $configData = [
            'MAIL_HOST' => $arrRequest['host'] ? trim($arrRequest['host']) : '',
            'MAIL_PORT' => $arrRequest['port'] ? trim($arrRequest['port']) : 25,
            'MAIL_USERNAME' => $arrRequest['user'] ? trim($arrRequest['user']) : '',
            'MAIL_PASSWORD' => $arrRequest['password'] ? trim($arrRequest['password']) : '',
            'MAIL_FROM_ADDRESS' => $arrRequest['from'] ? trim($arrRequest['from']) : '',
            'MAIL_FROM_NAME' => $arrRequest['fromName'] ?  trim($arrRequest['fromName']) : ''
        ];
        $oldConfig = hst_config('email');
    	hst_save_config('email', $data);
        hst_updateEnvInfo($configData);
        $this->addOperationLog(hst_lang('hstcms::manage.config.email.update'),'', hst_config('email'), $oldConfig);
        return $this->showMessage('hstcms::public.save.success');
    }

    public function test(Request $request)
    {
        $config = hst_config('email');
        $this->viewData['navs'] = $this->getNavs('test');
        return $this->loadTemplate('email.test', ['config'=>$config]);
    }

    public function testSubmit(Request $request)
    {
        $toemail = $request->get('toemail');
        $validator = Validator::make($request->all(), [
            'toemail' => 'required|email'
        ],[
            'toemail.required'=>hst_lang('hstcms::manage.email.toemail.empty'),
            'toemail.email'=>hst_lang('hstcms::manage.email.toemail.error')
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $flag = Mail::queue('hstcms::mail.test', [], function($message) use($toemail) {
            $message ->to($toemail)->subject(hst_lang('hstcms::manage.email.test.title'));
        });
        if($flag == 1) {
            $this->addOperationLog(hst_lang('hstcms::public.to').$toemail.hst_lang('hstcms::manage.email.test.success'));
            return $this->showMessage('hstcms::public.send.success');
        } else {
            $this->addOperationLog(hst_lang('hstcms::public.to').$toemail.hst_lang('hstcms::manage.email.test.error'));
            return $this->showMessage('hstcms::public.send.error');
        }
    }
}

