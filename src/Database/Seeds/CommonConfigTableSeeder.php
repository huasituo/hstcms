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
                    'name' => 'icp',
                    'namespace' => 'site',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'time.cv',
                    'namespace' => 'site',
                    'value' => '0',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'closemsg',
                    'namespace' => 'site',
                    'value' => '<h1>暂时关闭注册</h1>',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'visit.state',
                    'namespace' => 'site',
                    'value' => '0',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'visit.message',
                    'namespace' => 'site',
                    'value' => '网站正关闭维护中，请稍微访问',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL
                ], [
                    'name' => 'visit.message.template',
                    'namespace' => 'site',
                    'value' => 'close',
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
                    'name' => 'host',
                    'namespace' => 'ftp',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'port',
                    'namespace' => 'ftp',
                    'value' => '21',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'username',
                    'namespace' => 'ftp',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
                    'created_at' => NULL,
                    'created_at' => NULL
                ], [
                    'name' => 'password',
                    'namespace' => 'ftp',
                    'value' => '',
                    'vtype' => 'string',
                    'desc' => '',
                    'issystem' => 0,
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
                ]
            ]

            //array (
            // 0 => 
            // array (
            //     'name' => 'icp',
            //     'namespace' => 'site',
            //     'value' => '',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 1,
            //     'created_at' => NULL,
            //     'updated_at' => NULL,
            // ),
            // 1 => 
            // array (
            //     'name' => 'time.cv',
            //     'namespace' => 'site',
            //     'value' => '0',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 1,
            //     'created_at' => NULL,
            //     'updated_at' => NULL,
            // ),
            // 2 => 
            // array (
            //     'name' => 'closemsg',
            //     'namespace' => 'site',
            //     'value' => '<h1>暂时关闭注册</h1>',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 1,
            //     'created_at' => NULL,
            //     'updated_at' => NULL,
            // ),
            // 3 => 
            // array (
            //     'name' => 'visit.state',
            //     'namespace' => 'site',
            //     'value' => '0',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 1,
            //     'created_at' => NULL,
            //     'updated_at' => NULL,
            // ),
            // 4 => 
            // array (
            //     'name' => 'visit.message',
            //     'namespace' => 'site',
            //     'value' => '网站正关闭维护中，请稍微访问',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 1,
            //     'created_at' => NULL,
            //     'updated_at' => NULL,
            // ),
            // 5 => 
            // array (
            //     'name' => 'visit.message.template',
            //     'namespace' => 'site',
            //     'value' => 'close',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 1,
            //     'created_at' => NULL,
            //     'updated_at' => NULL,
            // ),
            // 6 => 
            // array (
            //     'name' => 'host',
            //     'namespace' => 'email',
            //     'value' => 'smtp.ym.163.com',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 0,
            //     'created_at' => NULL,
            //     'updated_at' => '2017-12-03 11:02:13',
            // ),
            // 7 => 
            // array (
            //     'name' => 'port',
            //     'namespace' => 'email',
            //     'value' => '25',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 0,
            //     'created_at' => NULL,
            //     'updated_at' => '2017-12-03 11:02:13',
            // ),
            // 8 => 
            // array (
            //     'name' => 'from',
            //     'namespace' => 'email',
            //     'value' => '',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 0,
            //     'created_at' => NULL,
            //     'updated_at' => '2017-12-03 11:02:13',
            // ),
            // 9 => 
            // array (
            //     'name' => 'from.name',
            //     'namespace' => 'email',
            //     'value' => '',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 0,
            //     'created_at' => NULL,
            //     'updated_at' => '2017-12-03 11:02:13',
            // ),
            // 10 => 
            // array (
            //     'name' => 'auth',
            //     'namespace' => 'email',
            //     'value' => '1',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 0,
            //     'created_at' => NULL,
            //     'updated_at' => '2017-12-03 11:02:13',
            // ),
            // 11 => 
            // array (
            //     'name' => 'user',
            //     'namespace' => 'email',
            //     'value' => '',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 0,
            //     'created_at' => NULL,
            //     'updated_at' => '2017-12-03 11:02:13',
            // ),
            // 12 => 
            // array (
            //     'name' => 'password',
            //     'namespace' => 'email',
            //     'value' => '',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 0,
            //     'created_at' => NULL,
            //     'updated_at' => '2017-12-03 11:02:13',
            // ),
            // 13 => 
            // array (
            //     'name' => 'manage.request',
            //     'namespace' => 'safe',
            //     'value' => '1',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 1,
            //     'created_at' => NULL,
            //     'updated_at' => '2017-12-06 07:46:56',
            // ),
            // 14 => 
            // array (
            //     'name' => 'manage.operation',
            //     'namespace' => 'safe',
            //     'value' => '1',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 1,
            //     'created_at' => NULL,
            //     'updated_at' => '2017-12-06 07:46:56',
            // ),
            // 15 => 
            // array (
            //     'name' => 'manage.login.ips',
            //     'namespace' => 'safe',
            //     'value' => '',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 1,
            //     'created_at' => NULL,
            //     'updated_at' => '2017-12-06 07:46:56',
            // ),
            // 16 => 
            // array (
            //     'name' => 'manage.login.ctime',
            //     'namespace' => 'safe',
            //     'value' => '60',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 1,
            //     'created_at' => NULL,
            //     'updated_at' => '2017-12-06 07:46:56',
            // ),
            // 17 => 
            // array (
            //     'name' => 'host',
            //     'namespace' => 'ftp',
            //     'value' => '',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 0,
            //     'created_at' => NULL,
            //     'updated_at' => '2017-12-03 16:47:46',
            // ),
            // 18 => 
            // array (
            //     'name' => 'port',
            //     'namespace' => 'ftp',
            //     'value' => '21',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 0,
            //     'created_at' => NULL,
            //     'updated_at' => '2017-12-03 16:47:46',
            // ),
            // 19 => 
            // array (
            //     'name' => 'username',
            //     'namespace' => 'ftp',
            //     'value' => '',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 0,
            //     'created_at' => NULL,
            //     'updated_at' => '2017-12-03 16:47:46',
            // ),
            // 20 => 
            // array (
            //     'name' => 'password',
            //     'namespace' => 'ftp',
            //     'value' => '',
            //     'vtype' => 'string',
            //     'desc' => '',
            //     'issystem' => 0,
            //     'created_at' => NULL,
            //     'updated_at' => '2017-12-03 16:47:46',
            // ),
            // )
        );
    }
}