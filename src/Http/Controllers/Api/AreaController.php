<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Api;

use Huasituo\Hstcms\Http\Controllers\Api\BasicController as ApiBaseController;


use Huasituo\Hstcms\Model\CommonAreaModel;

use Illuminate\Http\Request;
/**
* 
*/
class AreaController extends ApiBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function list(Request $request) 
    {
        $areaid = $request->get('id');
        $citys = CommonAreaModel::getSubByAreaid($areaid);
        if($citys) {
            foreach ($citys as $key => $value) {
                unset($citys[$key]['zip'], $citys[$key]['initials'], $citys[$key]['parentid'], $citys[$key]['joinname']);
            }
        }
        return $this->message('success', $citys);
    }

    public function citys(Request $request) 
    {
        $citys = CommonAreaModel::getCacheCityAll();
        return $this->message('success', $citys);
    }

    public function getId(Request $request) 
    {
        $province = (string)$request->get('province');
        $city = (string)$request->get('city');
        $area = (string)$request->get('area');
        $noData = [
                'province'=>'',
                'provinceid'=>0,
                'city'=>'',
                'cityid'=>0,
                'area'=>'',
                'areaid'=>0 
            ];
        if(!$province && !$city && !$area) {
            return $this->message('success', $noData);
        }
        $province = mb_ereg_replace('省', '', $province);
        $province = mb_ereg_replace('市', '', $province);
        $province = mb_ereg_replace('壮族自治区', '', $province);
        $province = mb_ereg_replace('回族自治区', '', $province);
        $province = mb_ereg_replace('维吾尔自治区', '', $province);
        $province = mb_ereg_replace('自治区', '', $province);
        $province = mb_ereg_replace('特别行政区', '', $province);
        $province = mb_ereg_replace('特別行政區', '', $province);

        $city = mb_ereg_replace('市', '', $city);
        $city = mb_ereg_replace('特别行政区', '', $city);
        $city = mb_ereg_replace('特別行政區', '', $city);
        $city = mb_ereg_replace('地区', '', $city);
        $city = mb_ereg_replace('蒙古自治州', '', $city);
        $city = mb_ereg_replace('回族自治州', '', $city);
        $city = mb_ereg_replace('回族自治州', '', $city);
        $city = mb_ereg_replace('哈萨克自治州', '', $city);
        $city = mb_ereg_replace('自治州', '', $city);

        $area = mb_ereg_replace('区', '', $area);
        $area = mb_ereg_replace('县', '', $area);
        $provinceInfo = CommonAreaModel::where('name', $province)->select('areaid', 'name')->first();
        if($province && $city && $area) {
            if(!$provinceInfo) {
                return $this->message('success', $noData);
            }
            $cityInfo = CommonAreaModel::where('parentid', $provinceInfo['areaid'])->where('name', $city)->select('areaid', 'name')->first(); 
            if(!$cityInfo) {
                return $this->message('success', $noData);
            }
            $areaInfo = CommonAreaModel::where('parentid', $cityInfo['areaid'])->where('name', $area)->select('areaid', 'name')->first(); 
            if(!$areaInfo) {
                return $this->message('success', $noData);
            }
            return $this->message('success',[
                'province'=>$provinceInfo['name'],
                'provinceid'=>$provinceInfo['areaid'],
                'city'=>$cityInfo['name'],
                'cityid'=>$cityInfo['areaid'],
                'area'=>$areaInfo['name'],
                'areaid'=>$areaInfo['areaid'], 
            ]);
        }
        if($province && $city && !$area) {
            if(!$provinceInfo) {
                return $this->message('success', $noData);
            }
            $cityInfo = CommonAreaModel::where('parentid', $provinceInfo['areaid'])->where('name', $city)->select('areaid', 'name')->first(); 
            if(!$cityInfo) {
                return $this->message('success', $noData);
            }
            return $this->message('success',[
                'province'=>$provinceInfo['name'],
                'provinceid'=>$provinceInfo['areaid'],
                'city'=>$cityInfo['name'],
                'cityid'=>$cityInfo['areaid'],
                'area'=>'',
                'areaid'=>0, 
            ]);
        }
        if($province && !$city && !$area) {
            if(!$provinceInfo) {
                return $this->message('success', $noData);
            }
            return $this->message('success',[
                'province'=>$provinceInfo['name'],
                'provinceid'=>$provinceInfo['areaid'],
                'city'=>'',
                'cityid'=>0,
                'area'=>'',
                'areaid'=>0, 
            ]);
        }
        return $this->message('success', $noData);
    }
}