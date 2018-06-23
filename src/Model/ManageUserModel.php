<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Cache;

class ManageUserModel extends Model
{
    protected $table = 'manage_user';

    protected $fillable = [
        'uid', 'username', 'email', 'password', 'salt', 'status', 'avatar', 'name', 'mobile', 'gid', 'qq', 'weixin'
    ];
    public $timestamps = false;

    public function __construct()
    {
        parent::__construct();
    }

    static function checkPassword($username, $password)
    {
    	$uinfo = ManageUserModel::where('username', $username)->first();
    	if(!$uinfo) {
    		return false;
    	}
    	if(hst_md5($password, $uinfo['salt']) != $uinfo['password']) {
    		return false;
    	}
    	return true;
    }

    static function getFounder()
    {
        $users = self::getAll();
        $founders = [];
        foreach ($users as $key => $value) {
            if($value['gid'] == 99) {
                $founders[$key] = $value;
            }
        }
        return $founders;
    }

    static function managerDoLogin($user)
    {
        return Session::put('manager', encrypt($user['uid'].'|'.$user['username'].'|'.$user['mobile'].'|'.$user['email'].'|'.hst_time()));
    }

    static function getUsers()
    {
        $users = self::getAll();
        $data = [];
        foreach ($users as $key => $value) {
            if($value['gid'] != 99) {
                $data[$key] = $value;
            }
        }
        return $data;
    }

    static function getUser($uid = 0)
    {
        if(!$uid) return [];
        $users = self::getAll();
        return isset($users[$uid]) && $users[$uid] ? $users[$uid] : [];
    }

    static function getAll()
    {
        if (!Cache::has('manageUser')) {
            $data = self::setCache();
        } else {
            $data = Cache::get('manageUser');
        }
        return $data;
    }

    static function setCache($result = true) 
    {
        $cacheData = [];
        $data = ManageUserModel::where('uid', '>', 0)->orderBy('uid', 'desc')->get();
        foreach ($data as $key => $value) {
            $cacheData[$value['uid']] = [
                'uid'=>trim($value['uid']),
                'username'=>trim($value['username']),
                'password'=>trim($value['password']),
                'salt'=>trim($value['salt']),
                'status'=>trim($value['status']),
                'avatar'=>trim($value['avatar']),
                'name'=>trim($value['name']),
                'mobile'=>trim($value['mobile']),
                'email'=>trim($value['email']),
                'gid'=>trim($value['gid']),
                'qq'=>trim($value['qq']),
                'weixin'=>trim($value['weixin'])
            ];
        }
        Cache::forever('manageUser', $cacheData);
        if(!$result) {
            unset($data);
            unset($cacheData);
            return '';
        }
        return $cacheData;
    }
}
