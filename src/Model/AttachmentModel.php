<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Model;

use Illuminate\Database\Eloquent\Model;
use Huasituo\Hstcms\Libraries\HstcmsStorage;

class AttachmentModel extends Model
{
    protected $table = 'attachs';

    protected $fillable = [
        'aid', 'name', 'type', 'size', 'path', 'ifthumb', 'created_userid', 'created_time', 'app', 'app_id', 'descrip', 'disk'
    ];
    public $timestamps = false;

    static function getStorages($k = '') 
    {
        $storages = [
            'local' => [
                'name'=>hst_lang('hstcms::manage.attachment.local'),
                'desc'=>'',
                'manageurl'=>''
            ],
            'public' => [
                'name'=>hst_lang('hstcms::manage.attachment.public'),
                'desc'=>'',
                'manageurl'=>''
            ],
            'ftp' => [
                'name'=>hst_lang('hstcms::manage.attachment.ftp'),
                'desc'=>'',
                'manageurl'=>''
            ]
        ];
        $storages = hstcms_hook('s_attach', $storages, true);
        if($k) {
            return $storages[$k];
        }
        return $storages;
    }

    static function getAttach($aid = 0)
    {
        $attachInfo = AttachmentModel::where('aid', $aid)->first();
        if(!$attachInfo) {
            return [];
        }
        $attachInfo['url'] = hst_storage_url($attachInfo['path'], $attachInfo['disk']);
        return $attachInfo->toArray();
    }

    static function getAttachs($aids = [])
    {
        if(!$aids) {
            return [];
        }
        foreach ($aids as $aid) {
            $attachs[] = self::getAttach($aid);
        }
        return $attachs;
    }

    static function deleteAttach($aid) 
    {
        $attachInfo = AttachmentModel::where('aid', $aid)->first();
        if($attachInfo) {
            $hstcmsStorage = new HstcmsStorage();
            $hstcmsStorage->disk = $attachInfo['disk'];
            $hstcmsStorage->delete($attachInfo['path']);
            AttachmentModel::where('aid', $aid)->delete();
        }
        return true;
    }

}
