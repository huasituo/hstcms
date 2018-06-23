<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Huasituo\Hstcms\Libraries\HstcmsSms;
use Huasituo\Hstcms\Libraries\HstcmsCurl;
use Uuid;
use Log;
use Huasituo\Hstcms\Libraries\HstcmsFields;
use Huasituo\Hstcms\Model\CommonFieldsModel;

use Huasituo\Hstcms\Libraries\HstcmsSign;
use Huasituo\Hstcms\Libraries\HstError;

use Huasituo\Hstcms\Libraries\HstcmsError;
use Huasituo\Hstcms\Libraries\HstcmsUpload;
use Huasituo\Hstcms\Libraries\HstcmsStorage;


use Illuminate\Support\Facades\Artisan;
use Huasituo\Hstcms\Libraries\HstcmsDb;
use Illuminate\Database\Schema\Blueprint;

use Huasituo\Hstcms\Model\CommonFormModel;
use Huasituo\Hstcms\Model\CommonAreaModel;

use Illuminate\Http\Request;
/**
* 
*/
class TestController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request) 
    {
        $a1=array("red"=>array("red","green"));
$a2=array("red"=>array("blue","yellow"));
print_r(array_merge($a1,$a2));
        //echo hst_word2pinyin('中国人', false, true, false, true);
        ///print_r(CommonAreaModel::getInfoByAreaid(5303, true));
        //return CommonAreaModel::getSubByAreaid(0)->toJson();
        // $slug = 'test';
        //     Artisan::call('module:migrate:refresh', [
        //         'slug'=>$slug,
        //         '--pretend'=>true
        //     ]);
        //  Artisan::call('hook:cache', [
        //     '--p'=>'Modules/'.ucfirst($slug),
        //     '--f'=>'app'
        // ]);
        echo hst_image_resize(231, ['width'=>100, 'height'=>100, 'type'=>'force']);
        // $HstcmsSign = new HstcmsSign();
        // $appid = 1819337410;
        // $data = [
        //     'appid'=>$appid,
        //     'name'=>232424
        // ];
        // $appInfo = hst_api_app($appid);
        // $sign = $HstcmsSign->createSign($data, $appInfo['secret']);
        // //$data['sign'] = $sign;
        // $HstcmsCurl = new HstcmsCurl();
        // $HstcmsCurl->url = Route('hstcmsApiText');
        // $HstcmsCurl->post($data);
        // $result = $HstcmsCurl->data(true);

        // CommonFormModel::addForm([
        //     'module'=>'hstcms',
        //     'name'=>'测试吧',
        //     'table'=>'form_test',
        //     'setting'=>[
        //         'verify'=>1,
        //         'mobile'=>'18664597716',
        //         'email'=>'8293293@qq.com',
        //         'email_title'=>'留言通知'
        //     ]
        // ]);

        // $HstcmsFields = new HstcmsFields();
        // $fields = CommonFieldsModel::getFields('form_liuyanbiao');
        // $inputHtml = $HstcmsFields->input_html($fields);
        // $this->viewData['inputHtml'] = $inputHtml;
        //CommonFormModel::deleteForm('form_test', 'hstcms');

        // $HstcmsDb = new HstcmsDb();
        // $HstcmsDb->databaseName = '';

        // echo $HstcmsDb->hasTable('common_config');
        // $colums =  $HstcmsDb->getColumnListing('common_config', 'value');
        // print_r($colums);

        // echo $HstcmsDb->createTable('xxxx',function(Blueprint $table)
        // {
        //     $table->increments('id')->comment('ID');
        // }); 
        
        //$HstcmsDb->renameTable('xxxx', 'oooo');
        // $HstcmsDb->renameColumn('oooo', 'vxxx3', 'vxxx8');
        // $HstcmsDb->addColumns('oooo', ['vxxx1', 'vxxx2', 'vxxx3'], [
        //         'vxxx1'=>[
        //     'type'=>'INT',
        //     'length1'=>10,
        //     'defaultValueType'=>'',
        //     'defaultValue'=>'3',
        //     'comment'=>'测试一下下啦1'
        // ],'vxxx2'=>[
        //     'type'=>'TINYINT',
        //     'length1'=>10,
        //     'defaultValueType'=>'',
        //     'defaultValue'=>'1',
        //     'comment'=>'测试一下下啦2'
        // ],'vxxx3'=>[
        //     'type'=>'VARCHAR',
        //     'length1'=>10,
        //     'defaultValueType'=>'',
        //     'defaultValue'=>'尼玛',
        //     'comment'=>'测试一下下啦3'
        // ],

        // ]);
        //echo $HstcmsDb->renameColumn('oooo', 'namespace', 'vspace');
        //$n = 222;
        //$HstcmsDb->table('xxxx', function(Blueprint $table) use($n)
        //{   
            //echo $n;
            //$table->string('namespace', 30)->default('')->comment(hst_lang('hstcms::public.namespace'));
        //});

        //echo route('hstsmsApiJxReport');  
    	//echo Uuid::generate();
        //return $this->showError('222');
        //$HstcmsSms = new HstcmsSms();
        //$HstcmsSms->getStatus(27);
    	//$result = $HstcmsSms->sendMobileMessage('18123938172', 'login');
		//$result = $Sms->checkVerify('18664597716', '931298s', 'register');
        //print_r($result);
		//if (isset($result['state']) && $result['state'] === 'error') return $this->showError($result['message']);
		//echo 'verify success';
    	//$this->showError('test');
         //echo route('hstsmsApiOldIndex');
        //echo storage::url('2018/05/24/add96657cac69707f4ede232367a89c9.jpg');
        // $hstcmsStorage = new HstcmsStorage();
        // // $hstcmsStorage->aid = 12;
        // $hstcmsStorage->file = '2018/05/24/560a9cfa0f2bcda894b18f95a1210d82.jpg';
        // $result = hst_storage_download(13);
        // if(hst_message_verify($result)) {
        //     return $this->showError($result['message']);
        // }
        // return $result;
        //echo hst_storage_url('sssfsfsdf.jpg');
        return $this->loadTemplate('hstcms::test.index');
    }

    public function pindex(Request $request)
    {
        $file = $request->file('filedata');
        $hstcmsUpload = new HstcmsUpload();
        $hstcmsUploads = $hstcmsUpload->setFile($file);
        if (hst_message_verify($hstcmsUploads) ) return $this->showError($hstcmsUploads['message']);
        $hstcmsUploads->doSave();
        $data = $hstcmsUploads->getData();
        $this->viewData['data'] = $data;
        return $this->showMessage('success');
    }
        /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function wechat(Request $request)
    {
        $app = app('wechat.official_account');
        $app->server->push(function ($message) {
            if(!isset($message['MsgType'])){
               return "欢迎关注 overtrue！";
            }
            switch ($message['MsgType']) {
                case 'event':
                    return '收到事件消息'.print_r($message, true);
                    break;
                case 'text':
                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                case 'file':
                    return '收到文件消息';
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
            // ...
        });
        return $app->server->serve();
    }

    //钩子测试页面
    public function hook(Request $request) 
    {
        $data = hstcms_hook('s_test_arr', ['a'=>1], true);
        return $this->loadTemplate('hstcms::test.hook', ['data'=>$data]);
    }

    //验证码测试页面
    public function captcha(Request $request)
    {
        return $this->loadTemplate('hstcms::test.captcha');
    }

    //验证码测试提交
    public function captchaCheck(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ],[
            'code.required'=>hst_lang('hstcms:captcha.please.enter.the.verification.code')
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
    }
}