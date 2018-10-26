<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Model;

use Illuminate\Database\Eloquent\Model;
use Auth;

class CommonSmsModel extends Model
{
    protected $table = 'sms_logs';

    protected $fillable = [
        'id', 'uid', 'type', 'note', 'content', 'mobile', 'times', 'status', 'sendnum', 'code', 'rtype', 'requestid', 'jstimes', 'stimes'
    ];
    public $timestamps = false;

    static function addInfo($mobile, $type, $code, $content = '', $note = '', $rtype = '', $requestid = 0, $uid = 0) {
        $postData = [
            'mobile'=>$mobile,
            'type'=>$type,
            'code'=>$code,
            'uid'=>isset($uid) && $uid ? $uid : (int)Auth::id(),
            'note'=>$note,
            'content'=>$content,
            'sendnum'=>1,
            'status'=>1,
            'requestid'=>(string)$requestid,
            'rtype'=>(string)$rtype,
            'times'=> hst_time()
        ];
        CommonSmsModel::insert($postData);
        return true;
    }

    static function getPlatform($k = '') 
    {
        $platforms = [
            'huasituo' => [
                'alias'=>'huasituo',
                'name'=>hst_lang('hstcms::manage.huasituo.sms'),
                'desc'=>hst_lang('hstcms::manage.huasituo.sms.tips'),
                'surl'=>route('manageSmsHstsmsConfig'),
                'components'=>'Huasituo\Hstcms\Libraries\HstcmsSmsApi'
            ]
        ];
        $platforms = hstcms_hook('s_sms', $platforms, true);
        if($k) {
            return isset($platforms[$k]) ? $platforms[$k] : [];
        }
        return $platforms;
    }

    static function getType($k = '')
    {
        $types = [
            'code'=>[
                'name'=>hst_lang('hstcms::public.captcha'),
                'num'=>'100',
                'content'=>'',
                'desc'=> '',
                'descs'=>hst_lang('hstcms::manage.sms.content.r'),
            ],
            'register'=>[
                'name'=>hst_lang('hstcms::public.register'),
                'num'=>'10',
                'content'=>'',
                'desc'=>hst_lang('hstcms::manage.sms.register.tips'),
                'descs'=>hst_lang('hstcms::manage.sms.content.r'),
            ],
            'login'=>[
                'name'=>hst_lang('hstcms::public.login'),
                'num'=>'15',
                'content'=>'',
                'desc'=>hst_lang('hstcms::manage.sms.login.tips'),
                'descs'=>hst_lang('hstcms::manage.sms.content.r'),
            ],
            'findpw'=>[
                'name'=>hst_lang('hstcms::public.findpw'),
                'num'=>'10',
                'content'=>'',
                'desc'=>hst_lang('hstcms::manage.sms.findpw.tips'),
                'descs'=>hst_lang('hstcms::manage.sms.content.r'),
            ],
        ];
        $types = hstcms_hook('s_sms_types', $types, true);
        if($k && isset($types[$k])) {
            return $types[$k];
        }
        return $types;
    }

}
