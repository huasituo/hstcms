<?php 

namespace Huasituo\Hstcms\Model;

use Illuminate\Database\Eloquent\Model;

class ManageOperationLogModel extends Model
{
    protected $table = 'manage_operation_log';

    protected $fillable = [
        'uid', 'username', 'times', 'status', 'ip', 'port', 'platform', 'browser', 'suid', 'susername', 'stimes', 'olddata', 'newdata', 'change', 'remark'
    ];
    public $timestamps = false;

    static function addLog($user, $remark = '', $change = '', $newdata = array(), $olddata = array())
    {
        $postData = [
            'uid'=>$user['uid'],
            'username'=>$user['username'],
            'times'=>hst_time(),
            'ip'=>hst_ip(),
            'port'=>hst_port(),
            'platform'=>hst_agent()->platform(),
            'browser'=>hst_agent()->browser(),
            'status'=>0,
            'remark'=>$remark,
            'change'=>$change,
            'olddata'=>serialize($olddata),
            'newdata'=>serialize($newdata),
            'suid'=>0,
            'susername'=>0,
            'stimes'=>0
        ];
        ManageOperationLogModel::insert($postData);
    }
}
