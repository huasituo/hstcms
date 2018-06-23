<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Model;

use Huasituo\Hstcms\Model\CommonRoleModel;

use Illuminate\Database\Eloquent\Model;
use Cache;

class ManageModulesModel extends Model
{

    protected $table = 'modules';
    protected $fillable = [
        'name', 'slug', 'description', 'times', 'version', 'enabled'
    ];
    public $timestamps = false;


    static function getData()
    {
        if (!Cache::has('hstmodules')) {
            $data = self::setCache();
        } else {
            $data = Cache::get('hstmodules');
        }
        return $data;
    }

    static function setCache($result = true) 
    {
        $cacheData = [];
        $data = ManageModulesModel::where('id', '>', '0')->get();
        foreach ($data as $key => $value) {
            $cacheData[$key] = [
                'id'=>trim($value['id']),
                'name'=>trim($value['name']),
                'slug'=>trim($value['slug']),
                'description'=>$value['description'],
                'times'=>$value['times'],
                'version'=>$value['version'],
                'enabled'=>$value['enabled'],
                'setting'=>hst_config('mod'.$value['slug'])
            ];
        }
        Cache::forget('hstmodules');
        Cache::forever('hstmodules', $cacheData);
        if(!$result) {
            unset($cacheData);
            return '';
        }
        return $cacheData;
    }
}
