<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Cache;

class CommonRoleModel extends Model
{
    protected $table = 'common_role';

    protected $fillable = [
        'id', 'name', 'auths', 'module'
    ];
    public $timestamps = false;

    static function getInfo($id)
    {
        $info = CommonRoleModel::where('id', $id)->first();
        $info['auths'] = explode(',', $info['auths']);
        return $info;
    }

    static function getRoles($module = 'manage')
    {
        $cacheName = $module.'Role';
        if (!Cache::has($cacheName)) {
            $data = self::setCache($module);
        } else {
            $data = Cache::get($cacheName);
        }
        return $data;
    }

    static function setCache($module = 'manage', $result = true) 
    {
        $cacheData = array();
        $data = CommonRoleModel::where('module', $module)->orderBy('id', 'desc')->get();
        foreach ($data as $key => $value) {
            $cacheData[$value['id']] = [
                'id'=>trim($value['id']),
                'name'=>trim($value['name']),
                'auths'=>trim($value['auths']),
                'module'=>trim($value['module'])
            ];
        }
        $cacheName = $module.'Role';
        Cache::forever($cacheName, $cacheData);
        if(!$result) {
            unset($cacheData);
            return '';
        }
        return $cacheData;
    }
}
