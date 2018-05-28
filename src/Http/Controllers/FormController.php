<?php 

namespace Huasituo\Hstcms\Http\Controllers;

use Huasituo\Hstcms\Http\Controllers\GlobalBasicController as BaseController;

use Huasituo\Hstcms\Model\CommonFormModel;
use Huasituo\Hstcms\Libraries\HstcmsFields;
use Huasituo\Hstcms\Model\CommonFieldsModel;
use Huasituo\Hstcms\Model\CommonFormContentModel;

use Auth;
use Illuminate\Http\Request;


class FormController extends BaseController
{
    public function show($formid, Request $request)
    {
        if(!$formid) {
            return $this->showError('hstcms::public.no.id', '', 5);
        }
        $info = CommonFormModel::getForm($formid);
        if(!$info) {
            return $this->showError('hstcms::public.no.data', '', 5);
        }
        $hstcmsFields = new HstcmsFields();
        $fields = CommonFieldsModel::getFields($info['table']);
        $inputHtml = $hstcmsFields->input_html($fields);
        $view = [
            'formid'=> $formid,
            'info'=> $info,
            'inputHtml'=>$inputHtml
        ];
        return $this->loadTemplate('hstcms::form.show', $view);
    }

    public function save(Request $request) 
    {
        $formid = $request->get('formid');
        if(!$formid) {
            return $this->showError('hstcms::public.no.id', '', 5);
        }
        $info = CommonFormModel::getForm($formid);
        if(!$info) {
            return $this->showError('hstcms::public.no.data', '', 5);
        }
        $hstcmsFields = new HstcmsFields();
        $fields = CommonFieldsModel::getFields($info['table']);
        $result = $hstcmsFields->validate_filter($request, $fields);
        if($result['status'] == 'error') {
            return $this->showError($result['error'], 2);
        }
        $psotData = $result['data'][$info['table']];
        $psotData['created_uid'] = (int)Auth::id();
        $psotData['created_time'] = hst_time();
        $psotData['created_ip'] = hst_ip();
        $psotData['created_port'] = hst_port();
        $psotData['vieworder'] = 0;
        $commonFormContentModel = new CommonFormContentModel();
        $commonFormContentModel->setTable($info['table']);
        $commonFormContentModel->insertGetId($psotData);
        return $this->showMessage('hstcms::public.add.success'); 
    }
}