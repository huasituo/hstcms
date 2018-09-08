<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Model;

use Cache; 
use Illuminate\Database\Eloquent\Model;

class CommonAreaModel extends Model
{
    protected $table = 'common_area';

    protected $fillable = [
        'areaid', 'name', 'joinname', 'parentid', 'vieworder', 'zip', 'initials'
    ];
    public $timestamps = false;

    static function updateData($areaid = 0, $data = []) {
        if(!$areaid) {
            return false;
        }
        CommonAreaModel::firstOrCreate(['areaid' => $areaid]);
        CommonAreaModel::where('areaid', $areaid)->update($data);
        return true;
    }

    static function getInfoByAreaid($areaid = 0, $subordinate = false)
    {
        $info = CommonAreaModel::where('areaid', $areaid)->first();
        if(!$info) {
            return [];
        }
        if(!$info['parentid']) {
            $data = [
                'areaid'=>$info['areaid'],
                'name'=>$info['name'],
                'joinname'=>$info['joinname'],
                'joinnames'=>explode('|', $info['joinname']),
                'joinids'=>[$areaid]
            ];
            if($subordinate) {
                $data['sublist'] = self::getSubByAreaid($areaid, $subordinate);
            }
            return $data;
        }
        if($info['parentid']) {
            $pinfo = CommonAreaModel::where('areaid', $info['parentid'])->select('areaid', 'parentid')->first();
            if(!$pinfo['parentid']) {
                $data =  [
                    'areaid'=>$info['areaid'],
                    'name'=>$info['name'],
                    'joinname'=>$info['joinname'],
                    'joinnames'=>explode('|', $info['joinname']),
                    'joinids'=>[$info['parentid'], $areaid]
                ];
                if($subordinate) {
                    $data['sublist'] = self::getSubByAreaid($areaid, $subordinate);
                }
                return $data;
            }
            if($pinfo['parentid']) {
                $ppinfo = CommonAreaModel::where('areaid', $pinfo['parentid'])->select('areaid')->first();
                $data =  [
                    'areaid'=>$info['areaid'],
                    'name'=>$info['name'],
                    'joinname'=>$info['joinname'],
                    'joinnames'=>explode('|', $info['joinname']),
                    'joinids'=>[$ppinfo['areaid'], $info['parentid'], $areaid]
                ];
                if($subordinate) {
                    $data['sublist'] = self::getSubByAreaid($areaid, $subordinate);
                }
                return $data;
            }
        }
    }

    static function getSubByAreaid($areaid = 0, $sublist = false, $dataType = 'array') 
    {
        $data = CommonAreaModel::where('parentid', $areaid)->select('areaid', 'name', 'joinname', 'parentid', 'zip')->get();
        if($dataType == 'array') {
            $data = $data->toArray();
        } else {
            $data = $data->toJson();
        }
        if($sublist) {
            foreach ($data as $key => $value) {
                $data[$key]['sublist'] = self::getSubByAreaid($value['areaid'], $sublist, $dataType);
            }
        }
        return $data;
    }
}
