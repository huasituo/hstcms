<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Model;

use Illuminate\Database\Eloquent\Model;
use Cache;

class CommonRoleUriModel extends Model
{
    protected $table = 'common_role_uri';

    protected $fillable = [
        'id', 'name', 'ename', 'uri', 'parent', 'remark', 'module'
    ];
    public $timestamps = false;

    static function getList($module = 'manage')
    {
        $cacheName = $module.'RoleUri';
        if (!Cache::has($cacheName)) {
            $data = self::setCache($module);
        } else {
            $data = Cache::get($cacheName);
        }
        $data = hstcms_hook('s_common_role_uri', $data, true);
        return $data;
    }

    static function getRoleUriDatas($module = 'manage')
    {
        $roleUris = CommonRoleUriModel::getList();
        $roleDatas = array();
        foreach ($roleUris as $key => $value) {
            $roleDatas[$value['parent']][] = ['name'=>$value['name'], 'ename'=>$value['ename'], 'uri'=>$value['uri']];
        }
        return $roleDatas;
    }

    static function addInfo($data, $module = 'manage') 
    {
        $postData = [
            'name'=>trim($data['name']),
            'ename'=>trim($data['ename']),
            'uri'=>trim($data['uri']),
            'parent'=>$data['parent'],
            'remark'=>$data['remark'],
            'module'=>$module,
        ];
        CommonRoleUriModel::insert($postData);
        self::setCache($module);
    }

    static function editInfo($id, $data, $module = 'manage') 
    {
        $postData = [
            'name'=>trim($data['name']),
            'ename'=>trim($data['ename']),
            'uri'=>trim($data['uri']),
            'remark'=>$data['remark'],
            'parent'=>$data['parent']
        ];
        CommonRoleUriModel::where('id', $id)->update($postData);
        self::setCache($module);
    }

    static function setCache($module = 'manage', $result = true) 
    {
        $cacheData = array();
        $data = CommonRoleUriModel::where('module', $module)->orderBy('id', 'desc')->get();
        foreach ($data as $key => $value) {
            $cacheData[$value['ename']] = [
                // 'id'=>trim($value['id']),
                'name'=>trim($value['name']),
                'ename'=>trim($value['ename']),
                'uri'=>trim($value['uri']),
                'remark'=>$value['remark'],
                'parent'=>$value['parent'],
                'module'=>$value['module']
            ];
        }
        $cacheName = $module.'RoleUri';
        Cache::forever($cacheName, $cacheData);
        if(!$result) {
            unset($cacheData);
            return '';
        }
        return $cacheData;
    }
}
