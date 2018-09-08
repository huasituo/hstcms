<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers;

use Huasituo\Hstcms\Http\Controllers\GlobalBasicController as BaseController;

use Huasituo\Hstcms\Model\CommonFormModel;
use Huasituo\Hstcms\Model\CommonFieldsModel;
use Huasituo\Hstcms\Libraries\HstcmsFields;
use Huasituo\Hstcms\Libraries\HstcmsPinYin;
use Huasituo\Hstcms\Model\CommonAreaModel;
use Illuminate\Http\Request;


class PublicController extends BaseController
{

    public function fieldsTypeHtml(Request $request) 
    {
        $id = $request->get('id');
        $type = $request->get('type');
        $rname = $request->get('rname');
        $relatedid = $request->get('relatedid');
    	$fieldInfo = CommonFieldsModel::getField($id);
        if ($fieldInfo) {
            $option = isset($fieldInfo['setting']['option']) ? $fieldInfo['setting']['option'] : [];
        } else {
            $option = [];
        }
        $fields = [];
        if($rname == 'form') {
            $formInfo = CommonFormModel::getForm($relatedid);
            $fields = CommonFieldsModel::getFields($formInfo['table'], $formInfo['module']);
        }
        $hstcmsFields = new HstcmsFields();
        $return = $hstcmsFields->option($type, $option, $fields);
        if ($return !== 0) {
            return $return;
        }
        return '';
    }

    public function topinyin(Request $request) 
    {
        $str = $request->get('str', TRUE);
        if (!$str) {
            return '';
        }
        $hstcmsPinYin = new HstcmsPinYin();
        exit($hstcmsPinYin->result($str));
    }

    public function getAreaSubList(Request $request)
    {
        $areaid = $request->get('areaid');
        if(!$areaid) {
            echo json_encode([]);
            exit;
        }
        $list = CommonAreaModel::getSubByAreaid($areaid, false);
        echo json_encode($list);
        exit;
    } 
}