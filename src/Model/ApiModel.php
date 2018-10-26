<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Model;

use Illuminate\Database\Eloquent\Model;
use Cache;

class ApiModel extends Model
{
    protected $table = 'common_api';

    protected $fillable = [
        'id', 'name', 'appid', 'secret', 'addtimes', 'edittimes', 'status'
    ];
    public $timestamps = false;

    static function setCache() 
    {
        $cacheName = 'hstcms:api';
        $data = ApiModel::where('id', '>', 0)->get();
        $vData = [];
        foreach ($data as $key => $value) {
            $vData[$value['appid']] = [
                'name'=>$value['name'],
                'appid'=>$value['appid'],
                'secret'=>$value['secret'],
                'addtimes'=>$value['addtimes'],
                'edittimes'=>$value['edittimes'],
                'status'=>$value['status']
            ];
        }
        Cache::forever($cacheName, $vData);
        return $vData;
    }
}
