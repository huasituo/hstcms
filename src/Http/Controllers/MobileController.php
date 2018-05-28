<?php

namespace Huasituo\Hstcms\Http\Controllers;

use Huasituo\Hstcms\Libraries\HstcmsSms;
use App\Modules\Account\Model\UsersModel;

use Illuminate\Http\Request;
use Auth;
/**
* 
*/
class MobileController extends GlobalBasicController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function send(Request $request) 
    {
        $mobile = $request->get('mobile');
        $type = $request->get('type');
        if(!$mobile) {
            return $this->showError('请输入手机号');
        }
        if(!$type) {
            return $this->showError('发送失败');
        }
        $user = UsersModel::getUsers($mobile, 'mobile', false);
        $uid = '';
        if(!Auth::id() && $user){
            $uid = $user['id']; 
        }
        $HstcmsSms = new HstcmsSms();
        $result = $HstcmsSms->sendMobileMessage($mobile, $type, [], $uid);
        if (isset($result['state']) && $result['state'] === 'error') return $this->showError($result['message']);
        return $this->showMessage('Hstcms::public.send.success');
    }

    public function verify(Request $request) 
    {
        $mobile = $request->get('mobile');
        $type = $request->get('type');
        $mobileCode = $request->get('mobile_code');
        if(!$mobile) {
            return $this->showError('请输入手机号');
        }
        if(!$mobileCode) {
            return $this->showError('请输入手机验证码');
        }
        if(!$type) {
            return $this->showError('验证失败');
        }
        $HstcmsSms = new HstcmsSms();
        $result = $HstcmsSms->checkVerify($mobile, $mobileCode, $type);
        if (isset($result['state']) && $result['state'] === 'error') return $this->showError($result['message']);
        return $this->showMessage('Hstcms::public.send.success');
    }
}