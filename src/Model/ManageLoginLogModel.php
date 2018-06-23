<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Model;

use Illuminate\Database\Eloquent\Model;

class ManageLoginLogModel extends Model
{
    protected $table = 'manage_login_log';

    protected $fillable = [
        'uid', 'username', 'times', 'remark', 'ip', 'port', 'device', 'browser'
    ];
    public $timestamps = false;

    static function addLog($user = [], $remark = '')
    {
        if(!$user) {
            $user = [
                'uid'=>0, 
                'username'=>'system'
            ];
        }
        $postData = [
            'uid'=>$user['uid'],
            'username'=>$user['username'],
            'times'=>hst_time(),
            'ip'=>hst_ip(),
            'port'=>hst_port(),
            'platform'=>hst_agent()->platform(),
            'browser'=>hst_agent()->browser(),
            'remark'=>$remark
        ];
        ManageLoginLogModel::insert($postData);
    }
}
