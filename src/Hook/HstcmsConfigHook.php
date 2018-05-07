<?php
namespace Huasituo\Hstcms\Hook;

/**
* 
*/
class HstcmsConfigHook 
{
	/**
     * 后台菜单钩子
     *
     * @param array $data 菜单数组
     * @return array
     */
    public function getManageMenu($data)
    {
        $data['manageSms'] = [
            'name' => hst_lang('hstcms::manage.sms.service'),
            'ename' => 'manageSms',
            'icon' => '',
            'url' => 'manageSms',
            'parent' => 'system',
            'parents' => 'config',
            'level' => 3,
            'module' => 'hstcms'
        ];
        $data['manageAttach'] = [
            'name' => hst_lang('hstcms::manage.attach.service'),
            'ename' => 'manageAttach',
            'icon' => '',
            'url' => 'manageAttach',
            'parent' => 'system',
            'parents' => 'config',
            'level' => 3,
            'module' => 'hstcms'
        ];
        $data['manageApi'] = [
            'name' => hst_lang('hstcms::manage.api.service'),
            'ename' => 'manageApi',
            'icon' => '',
            'url' => 'manageApi',
            'parent' => 'system',
            'parents' => 'tool',
            'level' => 3,
            'module' => 'hstcms'
        ];
        return $data;
    }

    /**
     * 后台权限点
     *
     * @param array $data 数组
     * @return array
     */
    public function getCommonRoleUri($data)
    {
        $data['manageSms'] = [
            'name' => hst_lang('hstcms::manage.sms.service'),
            'remark' => 'hstcms',
            'ename' => 'manageSms',
            'uri' => 'sms',
            'parent' => 'manageSms',
            'module' => 'hstcms'
        ];
        $data['manageSmsSave'] = [
            'name' => hst_lang('hstcms::manage.sms.service').hst_lang('hstcms::public.save'),
            'remark' => 'hstcms',
            'ename' => 'manageSmsSave',
            'uri' => 'sms/save',
            'parent' => 'manageSms',
            'module' => 'hstcms'
        ];

        $data['manageAttach'] = [
            'name' => hst_lang('hstcms::manage.attach.service'),
            'remark' => 'hstcms',
            'ename' => 'manageAttach',
            'uri' => 'attachments',
            'parent' => 'manageAttach',
            'module' => 'hstcms'
        ];
        $data['manageAttachSave'] = [
            'name' => hst_lang('hstcms::manage.attach.service').hst_lang('hstcms::public.save'),
            'remark' => 'hstcms',
            'ename' => 'manageAttachSave',
            'uri' => 'attachments/save',
            'parent' => 'manageAttach',
            'module' => 'hstcms'
        ];
        
        $data['manageApi'] = [
            'name' => hst_lang('hstcms::manage.api.service'),
            'remark' => 'hstcms',
            'ename' => 'manageApi',
            'uri' => 'api',
            'parent' => 'manageApi',
            'module' => 'hstcms'
        ];
        $data['manageApiSave'] = [
            'name' => hst_lang('hstcms::manage.api.service').hst_lang('hstcms::public.save'),
            'remark' => 'hstcms',
            'ename' => 'manageApiSave',
            'uri' => 'api/save',
            'parent' => 'manageApi',
            'module' => 'hstcms'
        ];
        return $data;
    }

    
}