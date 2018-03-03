<?php

namespace Huasituo\Hstcms\Database\Seeds;

use Illuminate\Database\Seeder;

class CommonRoleUriTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('common_role_uri')->delete();
        \DB::table('common_role_uri')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '配置',
                'uri' => 'custom/set',
                'parent' => 'customSet',
                'module' => 'manage',
                'ename' => 'customSet',
                'remark' => '常用设置',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '保存',
                'uri' => 'custom/set/save',
                'parent' => 'customSet',
                'module' => 'manage',
                'ename' => 'customSetSave',
                'remark' => '常用设置',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '配置',
                'uri' => 'safe/index',
                'parent' => 'manageSafeIndex',
                'module' => 'manage',
                'ename' => 'manageSafeIndex',
                'remark' => '安全配置',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '保存',
                'uri' => 'safe/save',
                'parent' => 'manageSafeIndex',
                'module' => 'manage',
                'ename' => 'manageSafeSave',
                'remark' => '安全配置',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '请求日志',
                'uri' => 'log/request',
                'parent' => 'manageLogRequest',
                'module' => 'manage',
                'ename' => 'manageLogRequest',
                'remark' => '日志管理',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '操作日志',
                'uri' => 'log/operation',
                'parent' => 'manageLogRequest',
                'module' => 'manage',
                'ename' => 'manageLogOperation',
                'remark' => '日志管理',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => '登录日志',
                'uri' => 'log/login',
                'parent' => 'manageLogRequest',
                'module' => 'manage',
                'ename' => 'manageLogLogin',
                'remark' => '日志管理',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => '查看操作日志',
                'uri' => 'log/operation/view/{id}',
                'parent' => 'manageLogRequest',
                'module' => 'manage',
                'ename' => 'manageLogOperationView',
                'remark' => '日志管理',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => '管理',
                'uri' => 'founder/index',
                'parent' => 'manageFounderIndex',
                'module' => 'manage',
                'ename' => 'manageFounderIndex',
                'remark' => '创始人',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => '添加',
                'uri' => 'founder/add',
                'parent' => 'manageFounderIndex',
                'module' => 'manage',
                'ename' => 'manageFounderAdd',
                'remark' => '创始人',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => '添加保存',
                'uri' => 'founder/add/save',
                'parent' => 'manageFounderIndex',
                'module' => 'manage',
                'ename' => 'manageFounderAddSave',
                'remark' => '创始人',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => '编辑',
                'uri' => 'founder/edit/{uid}',
                'parent' => 'manageFounderIndex',
                'module' => 'manage',
                'ename' => 'manageFounderEdit',
                'remark' => '创始人',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => '编辑保存',
                'uri' => 'founder/edit/save',
                'parent' => 'manageFounderIndex',
                'module' => 'manage',
                'ename' => 'manageFounderEditSave',
                'remark' => '创始人',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => '删除',
                'uri' => 'founder/delete',
                'parent' => 'manageFounderIndex',
                'module' => 'manage',
                'ename' => 'manageFounderDelete',
                'remark' => '创始人',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => '管理',
                'uri' => 'user/index',
                'parent' => 'manageUserIndex',
                'module' => 'manage',
                'ename' => 'manageUserIndex',
                'remark' => '工作人员',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => '添加',
                'uri' => 'user/add',
                'parent' => 'manageUserIndex',
                'module' => 'manage',
                'ename' => 'manageUserAdd',
                'remark' => '工作人员',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => '添加保存',
                'uri' => 'user/add/save',
                'parent' => 'manageUserIndex',
                'module' => 'manage',
                'ename' => 'manageUserAddSave',
                'remark' => '工作人员',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => '编辑',
                'uri' => 'user/edit/{id}',
                'parent' => 'manageUserIndex',
                'module' => 'manage',
                'ename' => 'manageUserEdit',
                'remark' => '工作人员',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => '编辑保存',
                'uri' => 'user/edit/save',
                'parent' => 'manageUserIndex',
                'module' => 'manage',
                'ename' => 'manageUserEditSave',
                'remark' => '工作人员',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => '删除',
                'uri' => 'user/delete',
                'parent' => 'manageUserIndex',
                'module' => 'manage',
                'ename' => 'manageUserDelete',
                'remark' => '工作人员',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => '管理',
                'uri' => 'menu/nav',
                'parent' => 'manageMenuNav',
                'module' => 'manage',
                'ename' => 'manageMenuNav',
                'remark' => '菜单',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => '添加',
                'uri' => 'menu/nav/add',
                'parent' => 'manageMenuNav',
                'module' => 'manage',
                'ename' => 'manageMenuNavAdd',
                'remark' => '菜单',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => '添加保存',
                'uri' => 'menu/nav/add/save',
                'parent' => 'manageMenuNav',
                'module' => 'manage',
                'ename' => 'manageMenuNavAddSave',
                'remark' => '菜单',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => '编辑',
                'uri' => 'menu/nav/edit/{id}',
                'parent' => 'manageMenuNav',
                'module' => 'manage',
                'ename' => 'manageMenuNavEdit',
                'remark' => '菜单',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => '编辑保存',
                'uri' => 'menu/nav/edit/save',
                'parent' => 'manageMenuNav',
                'module' => 'manage',
                'ename' => 'manageMenuNavEditSave',
                'remark' => '菜单',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => '删除',
                'uri' => 'menu/nav/delete',
                'parent' => 'manageMenuNava',
                'module' => 'manage',
                'ename' => 'manageMenuNavDelete',
                'remark' => '菜单',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => '角色',
                'uri' => 'role/index',
                'parent' => 'manageUserIndex',
                'module' => 'manage',
                'ename' => 'manageRoleIndex',
                'remark' => '工作人员角色',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => '角色添加',
                'uri' => 'role/add',
                'parent' => 'manageUserIndex',
                'module' => 'manage',
                'ename' => 'manageRoleAdd',
                'remark' => '工作人员角色',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => '角色添加保存',
                'uri' => 'role/add/save',
                'parent' => 'manageUserIndex',
                'module' => 'manage',
                'ename' => 'manageRoleAddSave',
                'remark' => '工作人员角色',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => '角色编辑',
                'uri' => 'role/edit/{id}',
                'parent' => 'manageUserIndex',
                'module' => 'manage',
                'ename' => 'manageRoleEdit',
                'remark' => '工作人员角色',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => '角色编辑保存',
                'uri' => 'role/edit/save',
                'parent' => 'manageUserIndex',
                'module' => 'manage',
                'ename' => 'manageRoleEditSave',
                'remark' => '工作人员角色',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => '角色删除',
                'uri' => 'role/delete/{id}',
                'parent' => 'manageUserIndex',
                'module' => 'manage',
                'ename' => 'manageRoleDelete',
                'remark' => '工作人员角色',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => '邮箱配置',
                'uri' => 'config/email',
                'parent' => 'manageConfigEmailIndex',
                'module' => 'manage',
                'ename' => 'manageConfigEmailIndex',
                'remark' => '邮箱配置',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => '保存',
                'uri' => 'config/email/save',
                'parent' => 'manageConfigEmailIndex',
                'module' => 'manage',
                'ename' => 'manageConfigEmailSave',
                'remark' => '邮箱配置',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => '测试',
                'uri' => 'config/email/test',
                'parent' => 'manageConfigEmailIndex',
                'module' => 'manage',
                'ename' => 'manageConfigEmailTest',
                'remark' => '邮箱配置',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => '测试发送',
                'uri' => 'config/email/test/submit',
                'parent' => 'manageConfigEmailIndex',
                'module' => 'manage',
                'ename' => 'manageConfigEmailTestSubmit',
                'remark' => '邮箱配置',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'FTP配置',
                'uri' => 'config/ftp',
                'parent' => 'manageConfigFtpIndex',
                'module' => 'manage',
                'ename' => 'manageConfigFtpIndex',
                'remark' => 'FTP配置',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => '保存',
                'uri' => 'config/ftp/save',
                'parent' => 'manageConfigFtpIndex',
                'module' => 'manage',
                'ename' => 'manageConfigFtpSave',
                'remark' => 'FTP配置',
            ),
        ));
        
        
    }
}