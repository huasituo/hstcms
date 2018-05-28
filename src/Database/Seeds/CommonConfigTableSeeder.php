<?php

namespace Huasituo\Hstcms\Database\Seeds;

use Illuminate\Database\Seeder;

class CommonConfigTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('common_config')->delete();
        \DB::table('common_config')->insert([
                [
                    'name' => 'name',
                    'namespace' => 'site',
                    'value' => '我的网站',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ],[
                    'name' => 'icp',
                    'namespace' => 'site',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'headerhtml',
                    'namespace' => 'site',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'footerhtml',
                    'namespace' => 'site',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'timezone',
                    'namespace' => 'site',
                    'value' => 'Asia/Shanghai',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'timecv',
                    'namespace' => 'site',
                    'value' => '0',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'vstate',
                    'namespace' => 'site',
                    'value' => '0',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'vmessage',
                    'namespace' => 'site',
                    'value' => '网站正关闭维护中，请稍微访问',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'vmtemplate',
                    'namespace' => 'site',
                    'value' => 'hstcms::common.close',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'url',
                    'namespace' => 'site',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'host',
                    'namespace' => 'email',
                    'value' => 'smtp.ym.163.com',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'port',
                    'namespace' => 'email',
                    'value' => '25',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'from',
                    'namespace' => 'email',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'from.name',
                    'namespace' => 'email',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'auth',
                    'namespace' => 'email',
                    'value' => '1',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'user',
                    'namespace' => 'email',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'password',
                    'namespace' => 'email',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'manage.request',
                    'namespace' => 'safe',
                    'value' => '1',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'manage.operation',
                    'namespace' => 'safe',
                    'value' => '1',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'manage.login.ips',
                    'namespace' => 'safe',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'manage.login.ctime',
                    'namespace' => 'safe',
                    'value' => '60',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'extsize',
                    'namespace' => 'attachment',
                    'value' => 'a:7:{s:3:"jpg";i:2048;s:3:"gif";i:2048;s:3:"png";i:2048;s:3:"bmp";i:2048;s:3:"xls";i:2048;s:4:"jpeg";i:2048;s:3:"zip";i:2048;}',
                    'vtype' => 'array',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'storage',
                    'namespace' => 'attachment',
                    'value' => 'local',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'dirs',
                    'namespace' => 'attachment',
                    'value' => 'ymd',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'key',
                    'namespace' => 'api',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'codelength',
                    'namespace' => 'sms',
                    'value' => '6',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'types',
                    'namespace' => 'sms',
                    'value' => 'a:3:{s:8:"register";a:2:{s:6:"status";i:1;s:7:"content";N;}s:5:"login";a:2:{s:6:"status";i:1;s:7:"content";N;}s:6:"findpw";a:2:{s:6:"status";i:1;s:7:"content";N;}}',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'platform',
                    'namespace' => 'sms',
                    'value' => 'huasituo',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'hstsmsdaima',
                    'namespace' => 'sms',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'hstsmskey',
                    'namespace' => 'sms',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'hstsmssign',
                    'namespace' => 'sms',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ],[
                    'name' => 'width',
                    'namespace' => 'captcha',
                    'value' => '120',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ],[
                    'name' => 'height',
                    'namespace' => 'captcha',
                    'value' => '60',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ],[
                    'name' => 'length',
                    'namespace' => 'captcha',
                    'value' => '5',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ]






                // ,
                // [
                //     'name' => 'host',
                //     'namespace' => 'ftp',
                //     'value' => '',
                //     'vtype' => 'string',
                //     'desc' => '',
                //     'issystem' => 0,
                //     'created_at' => NULL,
                //     'created_at' => NULL
                // ], [
                //     'name' => 'port',
                //     'namespace' => 'ftp',
                //     'value' => '21',
                //     'vtype' => 'string',
                //     'desc' => '',
                //     'issystem' => 0,
                //     'created_at' => NULL,
                //     'created_at' => NULL
                // ], [
                //     'name' => 'username',
                //     'namespace' => 'ftp',
                //     'value' => '',
                //     'vtype' => 'string',
                //     'desc' => '',
                //     'issystem' => 0,
                //     'created_at' => NULL,
                //     'created_at' => NULL
                // ], [
                //     'name' => 'password',
                //     'namespace' => 'ftp',
                //     'value' => '',
                //     'vtype' => 'string',
                //     'desc' => '',
                //     'issystem' => 0,
                //     'created_at' => NULL,
                //     'created_at' => NULL
                // ]
            ]
        );
    }
}