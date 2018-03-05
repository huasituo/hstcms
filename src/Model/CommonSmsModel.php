<?php 

namespace Huasituo\Hstcms\Model;

use Illuminate\Database\Eloquent\Model;
use Auth;

class CommonSmsModel extends Model
{
    protected $table = 'sms_logs';

    protected $fillable = [
        'id', 'uid', 'type', 'note', 'content', 'mobile', 'times', 'status', 'sendnum', 'code'
    ];
    public $timestamps = false;

    static function addInfo($mobile, $type, $code, $content = '', $note = '') {
        $postData = [
            'mobile'=>$mobile,
            'type'=>$type,
            'code'=>$code,
            'uid'=>Auth::id(),
            'note'=>$note,
            'content'=>$content,
            'sendnum'=>1,
            'status'=>1,
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
                'components'=>'Huasituo\Hstcms\Libraries\Hstsms'
            ]
        ];
        if($k) {
            return $platforms[$k];
        }
        return $platforms;
    }

    static function getType($k = '')
    {
        $types = [
            'register'=>[
                'name'=>hst_lang('hstcms::public.register'),
                'num'=>'5',
                'desc'=>hst_lang('hstcms::manage.sms.register.tips'),
                'descs'=>hst_lang('hstcms::manage.sms.content.r'),
            ],
            'login'=>[
                'name'=>hst_lang('hstcms::public.login'),
                'num'=>'5',
                'desc'=>hst_lang('hstcms::manage.sms.login.tips'),
                'descs'=>hst_lang('hstcms::manage.sms.content.r'),
            ],
            'findpw'=>[
                'name'=>hst_lang('hstcms::public.findpw'),
                'num'=>'5',
                'desc'=>hst_lang('hstcms::manage.sms.findpw.tips'),
                'descs'=>hst_lang('hstcms::manage.sms.content.r'),
            ],
        ];
        if($k && isset($types[$k])) {
            return $types[$k];
        }
        return $types;
    }

}
