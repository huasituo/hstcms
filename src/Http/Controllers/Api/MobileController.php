<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Api;

use Huasituo\Hstcms\Http\Controllers\Api\BasicController as ApiBaseController;

use Huasituo\Hstcms\Libraries\HstcmsSms;
use App\Modules\Account\Model\UsersModel;

use Illuminate\Http\Request;
use Auth;
/**
* 
*/
class MobileController extends ApiBaseController
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
            return $this->message(hst_lang('hstcms::public.enter.one.mobile'), '-101');
        }
        if(!$type) {
            return $this->message(hst_lang('hstcms::public.send.error'), '-102');
        }
        $uid = '';
        $HstcmsSms = new HstcmsSms();
        $result = $HstcmsSms->sendMobileMessage($mobile, $type, [], $uid);
        if (hst_message_verify($result)) return $this->message($result['message'], '-103');
        return $this->message(hst_lang('hstcms::public.send.success'));
    }
}