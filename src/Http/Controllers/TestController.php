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
        //return $this->showError('当前属于非法操作');
        //         $a1=array("red"=>array("red","green"));
        // $a2=array("red"=>array("blue","yellow"));
        // print_r(array_merge($a1,$a2));
        //echo hst_word2pinyin('厦门', false, true, false, true);
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
        //echo hst_image_resize(231, ['width'=>100, 'height'=>100, 'type'=>'force']);
        // $HstcmsSign = new HstcmsSign();
        // $appid = 1819337410;
        // $data = [
        //     'appid'=>$appid,
        //     'name'=>232424
        // ];
        // $appInfo = hst_api_app($appid);
        // $sign = $HstcmsSign->createSign($data, $appInfo['secret']);
        // //$data['sign'] = $sign;
        // $data = [
        //     'mobile'=>'+86-18664597716'
        // ];
        $HstcmsCurl = new HstcmsCurl();
        //网易ok
        // $HstcmsCurl->url = 'http://reg.email.163.com/unireg/call.do?cmd=added.mobileverify.verifyIntMobileFormat';
        // $HstcmsCurl->get($data);
        // $result = $HstcmsCurl->data(false);
        //美团
//         $t='Accept: */*
// Accept-Encoding: gzip, deflate, br
// Accept-Language: zh-CN,zh;q=0.9,en;q=0.8
// Connection: keep-alive
// Content-Length: 18
// Content-Type: application/x-www-form-urlencoded; charset=UTF-8
// Cookie: __mta=88904356.1535687077412.1535687330505.1535687335006.10"; uuid=394558d4d25041f781a8.1535533824.1.0.0; _lx_utm=utm_source%3DBaidu%26utm_medium%3Dorganic; _lxsdk_cuid=16584f2bec40-0d20d6fca3382a-3467790a-13c680-16584f2bec5c8; SERV=www; passport.sid=FxQTPFnSKy8kiyVKUEwQHND55Fd0Vf1B; passport.sid.sig=RR9BrO93JxKnoEQMLLZPo5id4oA; mtcdn=K; ci=30; LREF=aHR0cDovL3d3dy5tZWl0dWFuLmNvbS9hY2NvdW50L3NldHRva2VuP2NvbnRpbnVlPWh0dHAlM0ElMkYlMkZzei5tZWl0dWFuLmNvbSUyRg%3D%3D; _lxsdk_s=1658e1512f7-044-a4f-444%7C%7C8
// Host: passport.meituan.com
// Origin: https://passport.meituan.com
// Referer: https://passport.meituan.com/account/unitivesignup?service=www&continue=http%3A%2F%2Fwww.meituan.com%2Faccount%2Fsettoken%3Fcontinue%3Dhttp%253A%252F%252Fsz.meituan.com%252F
// User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36
// X-Client: javascript
// X-CSRF-Token: 59HUTPCn-L5DLJZhBcoMMOkO-dz1kWvMAVbU
// X-Requested-With: XMLHttpRequest';
// $headers = explode("\n", $t);
        // $HstcmsCurl->url = 'https://passport.meituan.com/account/unitivesignup?service=www&continue=http%3A%2F%2Fwww.meituan.com%2Faccount%2Fsettoken%3Fcontinue%3Dhttp%253A%252F%252Fsz.meituan.com%252F';
        // $HstcmsCurl->cookie = 1;
        // $HstcmsCurl->get();
        // $result = $HstcmsCurl->data(false);

        // $HstcmsCurl->header = $headers;
        // $HstcmsCurl->url = 'https://passport.meituan.com/account/signupcheck';
        // $HstcmsCurl->cookie = 2;
        // $HstcmsCurl->post(['mobiles'=>'1111']);
        // $result = $HstcmsCurl->data(true);

//         // //新浪
// $t = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8
// Accept-Encoding: gzip, deflate, br
// Accept-Language: zh-CN,zh;q=0.9,en;q=0.8
// Cache-Control: max-age=0
// Connection: keep-alive
// Cookie: SCF=AhXquppOGe9ZATwX-wF8e-wVb3QV4MxGKZtsuSe_T0ETEgPyNipltl8jIit8FIuX3w_9HdlCnCa8r3KJOybR_2I.; UOR=www.cnblogs.com,v.t,; sso_info=v02m6alo5qztKWRk5iljpSQpZCToKWRk5SljpOEpZCToKadlqWkj5OIuIyToLSMk4iwjJOIwA==; U_TRS1=000000d9.d2253802.5a21025a.537c19ee; SINAGLOBAL=59.40.117.217_1512112731.285814; SGUID=1518402120000_91859444; Apache=172.16.92.25_1535685787.927379; ULV=1535685789974:7:2:2:172.16.92.25_1535685787.927379:1535685788614; lxlrttp=1532434326; UM_distinctid=1658e2e1545727-0e81de8be91ff1-3467790a-13c680-1658e2e1546409; ULOGIN_IMG=gz-9d413a529b43fe7bb6c9b90495c3b1d130bc
// Host: login.sina.com.cn
// Referer: https://www.sina.com.cn/
// Upgrade-Insecure-Requests: 1
// User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36';
// $headers = explode("\n", $t);
//         $data = [
//             'name'=>'121212',
//             'format'=>'json',
//             'from'=>'mobile'
//         ];
//         $HstcmsCurl->url = 'https://login.sina.com.cn/signup/signup?entry=homepage';
//         $HstcmsCurl->cookie = 1;
//         $HstcmsCurl->get();
//         $result = $HstcmsCurl->data(false);
//         // print_r($result);

//         $url = 'https://login.sina.com.cn/signup/check_user.php';
//         $HstcmsCurl->url = $url;
//         $HstcmsCurl->cookie = 2;
//         $HstcmsCurl->header = $headers;
//         $HstcmsCurl->post($data);
//         $result = $HstcmsCurl->data(false);

        //百度ok
        // $HstcmsCurl->url = 'https://passport.baidu.com/v2/?regphonecheck&token=a29074093940ee5182dd1aeff7bbe140&tpl=mn&apiver=v3&moonshad=do802b15c0119f4ada539702678d6aa6a1&countrycode=&gid=46950E5-9EF4-42B3-BD7E-E34327F3F898&exchange=0&isexchangeable=1&action=reg&traceid=&callback=bd__cbs__lcc7bo';
        // $data = [
        //     'phone'=>'18664597716',
        //     't'=>hst_time()
        // ];
        // $HstcmsCurl->get($data);
        // $result = $HstcmsCurl->data(false);
        // $substr = substr_count($result, '400005');
        // print_r($substr);
        //百合网ok
        // $HstcmsCurl->url = 'http://my.baihe.com/register/emailCheckForXs?jsonCallBack=jQuery18301551828455401103_1535698926848';
        // $data = [
        //     'email'=>'18664597716',
        //     '_'=>hst_time()
        // ];
        // $HstcmsCurl->get($data);
        // $result = $HstcmsCurl->data(false);
        // $substr = substr_count($result, '"state":1,"data"');
        // print_r($substr);
        //安居客用户 ok
        // $HstcmsCurl->url = 'https://login.anjuke.com/login/checkphone';
        // $data = [
        //     'phone'=>'15112358980',
        //     '_'=>hst_time()
        // ];
        // $HstcmsCurl->get($data);
        // $result = $HstcmsCurl->data(true);
        // print_r($result);
        //安居客经纪人 ok
        // $HstcmsCurl->url = 'http://vip.anjuke.com/broker/register/';
        // $data = [
        //     'mobile'=>'15112358980',
        //     'tmp'=>hst_time()
        // ];
        // $HstcmsCurl->get($data);
        // $result = $HstcmsCurl->data(true);      //"used"  "no use"
        // print_r($result);
        //前程无忧 ok
        // $HstcmsCurl->url = 'https://login.51job.com/ajax/checkinfo.php?type=mobile&nation=CN';
        // $data = [
        //     'value'=>'18638106558',
        //     '_'=>hst_time()
        // ];
        // $HstcmsCurl->get($data);
        // $result = $HstcmsCurl->data(false);      //"used"  "no use"
        // print_r($result);

            //赶集
//         $HstcmsCurl->url = 'https://passport.ganji.com/register.php?next=/';
//         $HstcmsCurl->cookie = 1;
//         $HstcmsCurl->get();
//         $results = $HstcmsCurl->data(false);

//         preg_match_all("/window.PAGE_CONFIG.__hash__ = '(.*)';/U", $results, $hashs);


//         $t='Accept: application/json, text/javascript, */*; q=0.01
// Accept-Encoding: gzip, deflate, br
// Accept-Language: zh-CN,zh;q=0.9,en;q=0.8
// Connection: keep-alive
// Content-Length: 103
// Content-Type: application/x-www-form-urlencoded; charset=UTF-8
// Cookie: ganji_xuuid=d5f2f9b0-9aa5-43d4-eada-a1fd9c6e0ce3.1535699983507; ganji_uuid=8395391986230419896953; _gl_tracker=%7B%22ca_source%22%3A%22www.baidu.com%22%2C%22ca_name%22%3A%22-%22%2C%22ca_kw%22%3A%22-%22%2C%22ca_id%22%3A%22-%22%2C%22ca_s%22%3A%22seo_baidu%22%2C%22ca_n%22%3A%22-%22%2C%22ca_i%22%3A%22-%22%2C%22sid%22%3A55183626799%7D; GANJISESSID=ont8b7lkqsohctaqcofmp2c2ud; lg=1; statistics_clientid=me; __utma=32156897.425154637.1535699986.1535699986.1535699986.1; __utmc=32156897; __utmz=32156897.1535699986.1.1.utmcsr=sz.ganji.com|utmccn=(referral)|utmcmd=referral|utmcct=/; ganji_login_act=1535700235782; __utmb=32156897.4.10.1535699986
// Host: passport.ganji.com
// Origin: https://passport.ganji.com
// Referer: https://passport.ganji.com/register.php?next=/
// User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36
// X-Requested-With: XMLHttpRequest';
// $headers = explode("\n", $t);
//         $HstcmsCurl->url = 'https://passport.ganji.com/ajax.php?module=check_phone_by_reg';
//         $data = [
//             'reg_phone'=>'18664597712',
//             '__hash__'=>$hashs[1][0]
//         ];
//         $HstcmsCurl->post($data);
//         $HstcmsCurl->cookie = 2;
//         $HstcmsCurl->header = $headers;
//         $result = $HstcmsCurl->data(true);
//         // $substr = substr_count($result, '"state":1,"data"');
//         print_r($result);
        //极客学院 ok
        // $HstcmsCurl->url = 'https://passport.jikexueyuan.com/check/phone?client=www&jsoncallback=jQuery21103105180376781871_1535727335864';
        // $data = [
        //     'phone'=>'18664597712'
        // ];
        // $HstcmsCurl->post($data);
        // $result = $HstcmsCurl->data(false);
        // $substr = substr_count($result, '"state":1,"data"');
        //jQuery21103105180376781871_1535727335864({"status":1,"msg":"手机可用"})

        //爱奇艺ok
        // $HstcmsCurl->url = 'https://passport.iqiyi.com/apis/user/check_account.action';
        // $data = [
        //     '__NEW'=>'1',
        //     'account'=>'18664597712'
        // ];
        // $HstcmsCurl->post($data);
        // $result = $HstcmsCurl->data(true);
        //凤凰网 ok
        // $HstcmsCurl->url = 'https://id.ifeng.com/api/checkMobile?callback=jQuery183007909344229951709_1535728869153';
        // $data = [
        //     'u'=>'18664597712'
        // ];
        // $HstcmsCurl->post($data);
        // $result = $HstcmsCurl->data(false);

        $HstcmsCurl->url = 'https://reg.gome.com.cn/register/validateExist/refuse.do';
        $data = [
            'login'=>'18664597712'
        ];
        $HstcmsCurl->post($data);
        $result = $HstcmsCurl->data(false);



            //房天下经纪云
         $HstcmsCurl->url = 'http://yun.fang.com/navi/register.html';
         $HstcmsCurl->cookie = 1;
         $HstcmsCurl->get();
         $results = $HstcmsCurl->data(false);


         $HstcmsCurl->url = 'https://passport.fang.com/checkPhonebinding.api?callback=myCallBack&Service=soufun-passport-web&_=1535729467297';
         $HstcmsCurl->cookie = 3;
         $HstcmsCurl->get([
            'MobilePhone'=>'18664597716'
        ]);
         $results = $HstcmsCurl->data(false);
        print_r($result);
        exit;

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