<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
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
            return $this->showError(hst_lang('hstcms::public.enter.one.mobile'));
        }
        if(!$type) {
            return $this->showError(hst_lang('hstcms::public.send.error'));
        }
        $user = UsersModel::getUsers($mobile, 'mobile', false);
        $uid = '';
        if(!Auth::id() && $user){
            $uid = $user['id']; 
        }
        $HstcmsSms = new HstcmsSms();
        $result = $HstcmsSms->sendMobileMessage($mobile, $type, [], $uid);
        if (hst_message_verify($result)) return $this->showError($result['message']);
        return $this->showMessage('Hstcms::public.send.success');
    }

    public function verify(Request $request) 
    {
        $mobile = $request->get('mobile');
        $type = $request->get('type');
        $mobileCode = $request->get('mobile_code');
        if(!$mobile) {
            return $this->showError(hst_lang('hstcms::public.enter.one.mobile'));
        }
        if(!$mobileCode) {
            return $this->showError(hst_lang('hstcms::public.enter.one.mobile.code'));
        }
        if(!$type) {
            return $this->showError(hst_lang('hstcms::public.verification.failure'));
        }
        $HstcmsSms = new HstcmsSms();
        $result = $HstcmsSms->checkVerify($mobile, $mobileCode, $type);
        if (hst_message_verify($result))  return $this->showError($result['message']);
        return $this->showMessage('Hstcms::public.send.success');
    }
}