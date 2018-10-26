<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Model;

use Illuminate\Database\Eloquent\Model;
use Huasituo\Hstcms\Libraries\HstcmsStorage;
use Cache;

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
        if(!$aid) {
            return [];
        }
        $cacheName = 'hstcms:attachment:info:'.$aid;
        if (!Cache::has($cacheName)) {
            $info = self::setCacheInfo($aid);
        } else {
            $info = Cache::get($cacheName, []);
        }
        if(!$info) {
            return [];
        }
        $info['url'] = hst_storage_url($info['path'], $info['disk']);
        return $info;
    }

    static function setCacheInfo($aid = 0)
    {
        $info = AttachmentModel::where('aid', $aid)->first();
        $cacheName = 'hstcms:attachment:info:'.$aid;
        if($info) {
            Cache::forever($cacheName, $info->toArray());
            return $info->toArray();
        }
        // Cache::forever($cacheName, []);
        return [];
    }

    static function delCacheInfo($aid = 0)
    {
        $cacheName = 'hstcms:attachment:info:'.$aid;
        Cache::forget($cacheName);
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

    static function deleteAttachByAppId($app = '', $app_id) 
    {
        $attachs = AttachmentModel::where('app', $app)->where('app_id', $app_id)->select('aid')->get();
        if($attachs) {
            foreach ($attachs as $key => $value) {
                self::deleteAttach($value['aid']);
            }
        }
        return true;
    }

    static function updateAttach($aid, $app_id)
    {
        $postData = [
            'app_id'=>$app_id
        ];
        AttachmentModel::where('aid', $aid)->update($postData);
    }

    static function setTempData($tempid = '', $aid = 0)
    {
        if(!$tempid || !$aid) {
            return true;
        }
        $cacheName = 'hstcms:attachment:temp:'.$tempid;
        $data = Cache::get($cacheName, []);
        array_push($data, $aid);
        Cache::forever($cacheName, $data);
        return true;
    }

    static function delTempData($tempid = '')
    {
        if(!$tempid) {
            return true;
        }
        $cacheName = 'hstcms:attachment:temp:'.$tempid;
        Cache::forget($cacheName);
        return true;
    }
}
