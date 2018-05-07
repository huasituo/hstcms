<?php

namespace Huasituo\Hstcms\Http\Controllers;

use Huasituo\Hstcms\Libraries\Sms;
use Uuid;
use Log;

use Huasituo\Hstcms\Libraries\HstcmsError;
use Huasituo\Hstcms\Libraries\HstcmsUpload;

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
    	echo Uuid::generate();
        //return $this->showError('222');
        //$Sms = new Sms();

    	//$result = $Sms->sendMobileMessage('18664597716', 'register');
		//$result = $Sms->checkVerify('18664597716', '931298s', 'register');
		//if ($result instanceof HstError) return $this->showError($result->getError());
		//echo 'verify success';
    	//$this->showError('test');
         //echo route('hstsmsApiOldIndex');
        return $this->loadTemplate('hstcms::test');
    }

    public function pindex(Request $request)
    {
        $file = $request->file('image');
        $HstcmsUpload = new HstcmsUpload();
        $HstcmsUploads = $HstcmsUpload->setFile($file);
        if ($HstcmsUploads instanceof HstcmsError) return $this->showError($HstcmsUploads->getError());
        print_r($HstcmsUploads);
        $HstcmsUploads->doSave();
        $data = $HstcmsUploads->getData();
        print_r($data);
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
}