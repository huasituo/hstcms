<?php 

namespace Huasituo\Hstcms\Model;

use Illuminate\Database\Eloquent\Model;

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
                'alias'=>'local',
                'name'=>hst_lang('hstcms::manage.attachment.local'),
                'desc'=>'',
                'manageurl'=>''
            ],
            'ftp' => [
                'alias'=>'ftp',
                'name'=>hst_lang('hstcms::manage.attachment.ftp'),
                'desc'=>'',
                'manageurl'=>''
            ]
        ];
        if($k) {
            return $storages[$k];
        }
        return $storages;
    }

}
