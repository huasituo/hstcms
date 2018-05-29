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
        $data['manageHookIndex'] = [
            'name' => 'Hook',
            'ename' => 'manageHookIndex',
            'icon' => '',
            'url' => 'manageHookIndex',
            'parent' => 'system',
            'parents' => 'tool',
            'level' => 3,
            'module' => 'hstcms'
        ];
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
        // $data['manageApi'] = [
        //     'name' => hst_lang('hstcms::manage.api.service'),
        //     'ename' => 'manageApi',
        //     'icon' => '',
        //     'url' => 'manageApi',
        //     'parent' => 'system',
        //     'parents' => 'tool',
        //     'level' => 3,
        //     'module' => 'hstcms'
        // ];
        $data['manageModules'] = [
            'name' => hst_lang('hstcms::manage.modules.manage'),
            'ename' => 'manageModules',
            'icon' => '',
            'url' => 'manageModules',
            'parent' => 'system',
            'parents' => 'tool',
            'level' => 3,
            'module' => 'hstcms'
        ];
        $data['manageCaches'] = [
            'name' => hst_lang('hstcms::manage.caches.manage'),
            'ename' => 'manageCaches',
            'icon' => '',
            'url' => 'manageCaches',
            'parent' => 'system',
            'parents' => 'tool',
            'level' => 3,
            'module' => 'hstcms'
        ];

        $data['manageCaptchaIndex'] = [
            'name' => hst_lang('hstcms::captcha.name'),
            'ename' => 'manageCaptchaIndex',
            'icon' => '',
            'url' => 'manageCaptchaIndex',
            'parent' => 'system',
            'parents' => 'config',
            'level' => 3,
            'module' => 'hstcms'
        ];
        $data['manageFormIndex'] = [
            'name' => hst_lang('hstcms::manage.form'),
            'ename' => 'manageFormIndex',
            'icon' => '',
            'url' => 'manageFormIndex',
            'parent' => 'system',
            'parents' => 'config',
            'level' => 3,
            'module' => 'hstcms'
        ];
        $data['manageSpecialIndex'] = [
            'name' => hst_lang('hstcms::manage.special.manage'),
            'ename' => 'manageSpecialIndex',
            'icon' => '',
            'url' => 'manageSpecialIndex',
            'parent' => 'system',
            'parents' => 'config',
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
        $data['manageHookIndex'] = [
            'name' => hst_lang('hstcms::public.manage'),
            'remark' => 'HOOK',
            'ename' => 'manageHookIndex',
            'uri' => 'hook',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookAdd'] = [
            'name' => hst_lang('hstcms::public.add'),
            'remark' => 'HOOK',
            'ename' => 'manageHookAdd',
            'uri' => 'hook/add',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookAddSave'] = [
            'name' => hst_lang('hstcms::public.add', 'hstcms::public.save'),
            'remark' => 'HOOK',
            'ename' => 'manageHookAddSave',
            'uri' => 'hook/add/save',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookEdit'] = [
            'name' => hst_lang('hstcms::public.edit'),
            'remark' => 'HOOK',
            'ename' => 'manageHookEdit',
            'uri' => 'hook/edit/{name}',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookEditSave'] = [
            'name' => hst_lang('hstcms::public.edit', 'hstcms::public.save'),
            'remark' => 'HOOK',
            'ename' => 'manageHookEditSave',
            'uri' => 'hook/edit/save',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookDelete'] = [
            'name' => hst_lang('hstcms::public.delete'),
            'remark' => 'HOOK',
            'ename' => 'manageHookDelete',
            'uri' => 'hook/delete/{name}',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookCache'] = [
            'name' => hst_lang('hstcms::public.cache'),
            'remark' => 'HOOK',
            'ename' => 'manageHookCache',
            'uri' => 'hook/cache',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];

        $data['manageHookInjectIndex'] = [
            'name' => hst_lang('hstcms::public.manage'),
            'remark' => 'Hook Inject',
            'ename' => 'manageHookInjectIndex',
            'uri' => 'hook/inject/{name}',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookInjectIndex'] = [
            'name' => hst_lang('hstcms::public.add'),
            'remark' => 'Hook Inject',
            'ename' => 'manageHookInjectIndex',
            'uri' => 'hook/inject/{name}/add',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookInjectIndex'] = [
            'name' => hst_lang('hstcms::public.add', 'hstcms::public.save'),
            'remark' => 'Hook Inject',
            'ename' => 'manageHookInjectIndex',
            'uri' => 'hook/inject/{name}/add/save',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookInjectIndex'] = [
            'name' => hst_lang('hstcms::public.edit'),
            'remark' => 'Hook Inject',
            'ename' => 'manageHookInjectIndex',
            'uri' => 'hook/inject/{name}/edit/{id}',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookInjectIndex'] = [
            'name' => hst_lang('hstcms::public.edit', 'hstcms::public.save'),
            'remark' => 'Hook Inject',
            'ename' => 'manageHookInjectIndex',
            'uri' => 'hook/inject/{name}/edit/save',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookInjectDelete'] = [
            'name' => hst_lang('hstcms::public.delete'),
            'remark' => 'Hook Inject',
            'ename' => 'manageHookInjectDelete',
            'uri' => 'hook/inject/{name}/delete/{id}',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
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

        $data['manageConfigIndex'] = [
            'name' => hst_lang('hstcms::manage.config.site'),
            'remark' => 'hstcms',
            'ename' => 'manageConfigIndex',
            'uri' => 'index',
            'parent' => 'manageConfigIndex',
            'module' => 'hstcms'
        ];
        $data['mymanageConfigSave'] = [
            'name' => hst_lang('hstcms::manage.config.site').hst_lang('hstcms::public.save'),
            'remark' => 'hstcms',
            'ename' => 'mymanageConfigSave',
            'uri' => 'save',
            'parent' => 'manageConfigIndex',
            'module' => 'hstcms'
        ];

        $data['manageConfigGlobal'] = [
            'name' => hst_lang('hstcms::manage.config.global'),
            'remark' => 'hstcms',
            'ename' => 'manageConfigGlobal',
            'uri' => 'index',
            'parent' => 'manageConfigGlobal',
            'module' => 'hstcms'
        ];
        $data['manageConfigGlobalSave'] = [
            'name' => hst_lang('hstcms::manage.config.global').hst_lang('hstcms::public.save'),
            'remark' => 'hstcms',
            'ename' => 'manageConfigGlobalSave',
            'uri' => 'index',
            'parent' => 'manageConfigGlobal',
            'module' => 'hstcms'
        ];

        $data['manageModules'] = [
            'name' => hst_lang('hstcms::public.manage'),
            'remark' => 'hstcms',
            'ename' => 'manageModules',
            'uri' => 'modules',
            'parent' => 'manageModules',
            'module' => 'hstcms'
        ];
        $data['manageModulesUninstalls'] = [
            'name' => hst_lang('hstcms::manage.modules.uninstalls'),
            'remark' => 'hstcms',
            'ename' => 'manageModulesUninstalls',
            'uri' => 'modules/uninstalls',
            'parent' => 'manageModules',
            'module' => 'hstcms'
        ];
        $data['manageModulesDoinstalls'] = [
            'name' => hst_lang('hstcms::public.install'),
            'remark' => 'hstcms',
            'ename' => 'manageModulesDoinstalls',
            'uri' => 'modules/doinstalls',
            'parent' => 'manageModules',
            'module' => 'hstcms'
        ];
        $data['manageModulesEnableds'] = [
            'name' => hst_lang('hstcms::public.operation'),
            'remark' => 'hstcms',
            'ename' => 'manageModulesEnableds',
            'uri' => 'modules/enableds',
            'parent' => 'manageModules',
            'module' => 'hstcms'
        ];
        $data['manageModulesDouninstall'] = [
            'name' => hst_lang('hstcms::public.uninstall'),
            'remark' => 'hstcms',
            'ename' => 'manageModulesDouninstall',
            'uri' => 'modules/douninstall',
            'parent' => 'manageModules',
            'module' => 'hstcms'
        ];
        $data['manageModulesCache'] = [
            'name' => hst_lang('hstcms::public.cache'),
            'remark' => 'hstcms',
            'ename' => 'manageModulesCache',
            'uri' => 'modules/cache',
            'parent' => 'manageModules',
            'module' => 'hstcms'
        ];
        $data['manageCaches'] = [
            'name' => hst_lang('hstcms::manage.caches.manage'),
            'remark' => 'hstcms',
            'ename' => 'manageCaches',
            'uri' => 'caches',
            'parent' => 'manageCaches',
            'module' => 'hstcms'
        ];
        $data['manageCachesSave'] = [
            'name' => hst_lang('hstcms::public.save'),
            'remark' => 'hstcms',
            'ename' => 'manageCachesSave',
            'uri' => 'caches/save',
            'parent' => 'manageCaches',
            'module' => 'hstcms'
        ];
        $data['manageCachesMemcachedConfig'] = [
            'name' => hst_lang('hstcms::manage.caches.memcached.setting'),
            'remark' => 'hstcms',
            'ename' => 'manageCachesMemcachedConfig',
            'uri' => '/caches/memcached/config',
            'parent' => 'manageCaches',
            'module' => 'hstcms'
        ];
        $data['manageCachesMemcachedConfigSave'] = [
            'name' => hst_lang('hstcms::public.save', 'hstcms::manage.caches.memcached.setting'),
            'remark' => 'hstcms',
            'ename' => 'manageCachesMemcachedConfigSave',
            'uri' => 'index',
            'parent' => 'manageCaches',
            'module' => 'hstcms'
        ];

        $data['manageCaptchaIndex'] = [
            'name' => hst_lang('hstcms::captcha.name'),
            'remark' => 'captcha',
            'ename' => 'manageCaptchaIndex',
            'uri' => 'captcha/index',
            'parent' => 'manageCaptchaIndex',
            'module' => 'hstcms'
        ];
        $data['manageCaptchaSave'] = [
            'name' => hst_lang('hstcms::captcha.save'),
            'remark' => 'captcha',
            'ename' => 'manageCaptchaSave',
            'uri' => 'captcha/save',
            'parent' => 'manageCaptchaIndex',
            'module' => 'hstcms'
        ];


        $data['manageFormIndex'] = [
            'name' => hst_lang('hstcms::public.manage'),
            'remark' => 'form',
            'ename' => 'manageFormIndex',
            'uri' => 'form/index',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFormAdd'] = [
            'name' => hst_lang('hstcms::public.add'),
            'remark' => 'form',
            'ename' => 'manageFormAdd',
            'uri' => 'form/add',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFormAddSave'] = [
            'name' => hst_lang('hstcms::public.add').hst_lang('hstcms::public.save'),
            'remark' => 'form',
            'ename' => 'manageFormAddSave',
            'uri' => 'form/save',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFormEdit'] = [
            'name' => hst_lang('hstcms::public.edit'),
            'remark' => 'form',
            'ename' => 'manageFormEdit',
            'uri' => 'form/edit/{id}',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFormEditSave'] = [
            'name' => hst_lang('hstcms::public.edit').hst_lang('hstcms::public.save'),
            'remark' => 'form',
            'ename' => 'manageFormEditSave',
            'uri' => 'form/edit/save',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFormDelete'] = [
            'name' => hst_lang('hstcms::public.delete'),
            'remark' => 'form',
            'ename' => 'manageFormDelete',
            'uri' => 'form/delete/{id}',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFormContent'] = [
            'name' => hst_lang('hstcms::manage.form.content').hst_lang('hstcms::public.manage'),
            'remark' => 'form',
            'ename' => 'manageFormContent',
            'uri' => 'form/content/{formid}',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFormContentAdd'] = [
            'name' => hst_lang('hstcms::manage.form.content').hst_lang('hstcms::public.add'),
            'remark' => 'form',
            'ename' => 'manageFormContentAdd',
            'uri' => 'form/content/add/{formid}',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFormContentAddSave'] = [
            'name' => hst_lang('hstcms::manage.form.content').hst_lang('hstcms::public.add', 'hstcms::public.save'),
            'remark' => 'form',
            'ename' => 'manageFormContentAddSave',
            'uri' => 'form/content/add/save/{formid}',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFormContentEdit'] = [
            'name' => hst_lang('hstcms::manage.form.content').hst_lang('hstcms::public.edit'),
            'remark' => 'form',
            'ename' => 'manageFormContentEdit',
            'uri' => 'form/content/edit/{formid}/{id}',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFormContentEditSave'] = [
            'name' => hst_lang('hstcms::manage.form.content').hst_lang('hstcms::public.edit', 'hstcms::public.save'),
            'remark' => 'form',
            'ename' => 'manageFormContentEditSave',
            'uri' => 'form/content/edit/save/{formid}',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFormContentDelete'] = [
            'name' => hst_lang('hstcms::manage.form.content').hst_lang('hstcms::public.delete'),
            'remark' => 'form',
            'ename' => 'manageFormContentDelete',
            'uri' => 'form/content/delete/{formid}/{id}',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];


        $data['manageFieldsIndex'] = [
            'name' => hst_lang('hstcms::public.field').hst_lang('hstcms::public.manage'),
            'remark' => 'form',
            'ename' => 'manageFieldsIndex',
            'uri' => 'fields',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFieldsSave'] = [
            'name' => hst_lang('hstcms::public.field').hst_lang('hstcms::public.save'),
            'remark' => 'form',
            'ename' => 'manageFieldsSave',
            'uri' => 'fields/save',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFieldsAdd'] = [
            'name' => hst_lang('hstcms::public.field').hst_lang('hstcms::public.add'),
            'remark' => 'form',
            'ename' => 'manageFieldsAdd',
            'uri' => 'fields/add',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFieldsAddSave'] = [
            'name' => hst_lang('hstcms::public.field').hst_lang('hstcms::public.add','hstcms::public.save'),
            'remark' => 'form',
            'ename' => 'manageFieldsAddSave',
            'uri' => 'fields/add/save',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFieldsEdit'] = [
            'name' => hst_lang('hstcms::public.field').hst_lang('hstcms::public.edit'),
            'remark' => 'form',
            'ename' => 'manageFieldsEdit',
            'uri' => 'fields/edit',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFieldsEditSave'] = [
            'name' => hst_lang('hstcms::public.field').hst_lang('hstcms::public.edit','hstcms::public.save'),
            'remark' => 'form',
            'ename' => 'manageFieldsEditSave',
            'uri' => 'fields/edit/save',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFieldsCache'] = [
            'name' => hst_lang('hstcms::public.field').hst_lang('hstcms::public.cache'),
            'remark' => 'form',
            'ename' => 'manageFieldsCache',
            'uri' => 'fields/cache',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];
        $data['manageFieldsDelete'] = [
            'name' => hst_lang('hstcms::public.field').hst_lang('hstcms::public.delete'),
            'remark' => 'form',
            'ename' => 'manageFieldsDelete',
            'uri' => 'fields/delete',
            'parent' => 'manageFormIndex',
            'module' => 'hstcms'
        ];



        $data['manageSpecialIndex'] = [
            'name' => hst_lang('hstcms::manage.special.manage'),
            'remark' => 'special',
            'ename' => 'manageSpecialIndex',
            'uri' => 'special',
            'parent' => 'manageSpecialIndex',
            'module' => 'hstcms'
        ];
        $data['manageSpecialCache'] = [
            'name' => hst_lang('hstcms::public.cache'),
            'remark' => 'special cache',
            'ename' => 'manageSpecialCache',
            'uri' => 'special/cache',
            'parent' => 'manageSpecialIndex',
            'module' => 'hstcms'
        ];
        $data['manageSpecialAdd'] = [
            'name' => hst_lang('hstcms::public.add'),
            'remark' => 'special add',
            'ename' => 'manageSpecialAdd',
            'uri' => 'special/add',
            'parent' => 'manageSpecialIndex',
            'module' => 'hstcms'
        ];
        $data['manageSpecialAddSave'] = [
            'name' => hst_lang('hstcms::public.add','hstcms::public.save'),
            'remark' => 'special add save',
            'ename' => 'manageSpecialAddSave',
            'uri' => 'special/add/save',
            'parent' => 'manageSpecialIndex',
            'module' => 'hstcms'
        ];
        $data['manageSpecialEdit'] = [
            'name' => hst_lang('hstcms::public.edit'),
            'remark' => 'special edit',
            'ename' => 'manageSpecialEdit',
            'uri' => 'special/edit/{id}',
            'parent' => 'manageSpecialIndex',
            'module' => 'hstcms'
        ];
        $data['manageSpecialEditSave'] = [
            'name' => hst_lang('hstcms::public.edit','hstcms::public.save'),
            'remark' => 'special edit save',
            'ename' => 'manageSpecialEditSave',
            'uri' => 'special/edit/save',
            'parent' => 'manageSpecialIndex',
            'module' => 'hstcms'
        ];
        $data['manageSpecialDelete'] = [
            'name' => hst_lang('hstcms::public.delete'),
            'remark' => 'special delete',
            'ename' => 'manageSpecialDelete',
            'uri' => 'special/delete/{id}',
            'parent' => 'manageSpecialIndex',
            'module' => 'hstcms'
        ];



        return $data;
    }
}