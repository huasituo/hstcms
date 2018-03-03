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
        \DB::table('common_config')->insert(array (
            0 => 
            array (
                'id' => 428,
                'name' => 'icp',
                'namespace' => 'site',
                'value' => '',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 429,
                'name' => 'time.cv',
                'namespace' => 'site',
                'value' => '0',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 430,
                'name' => 'closemsg',
                'namespace' => 'site',
                'value' => '<h1>暂时关闭注册</h1>',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 431,
                'name' => 'visit.state',
                'namespace' => 'site',
                'value' => '0',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 432,
                'name' => 'visit.message',
                'namespace' => 'site',
                'value' => '网站正关闭维护中，请稍微访问',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 433,
                'name' => 'visit.message.template',
                'namespace' => 'site',
                'value' => 'close',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 434,
                'name' => 'host',
                'namespace' => 'email',
                'value' => 'smtp.ym.163.com',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 0,
                'created_at' => NULL,
                'updated_at' => '2017-12-03 11:02:13',
            ),
            7 => 
            array (
                'id' => 435,
                'name' => 'port',
                'namespace' => 'email',
                'value' => '25',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 0,
                'created_at' => NULL,
                'updated_at' => '2017-12-03 11:02:13',
            ),
            8 => 
            array (
                'id' => 436,
                'name' => 'from',
                'namespace' => 'email',
                'value' => '',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 0,
                'created_at' => NULL,
                'updated_at' => '2017-12-03 11:02:13',
            ),
            9 => 
            array (
                'id' => 437,
                'name' => 'from.name',
                'namespace' => 'email',
                'value' => '',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 0,
                'created_at' => NULL,
                'updated_at' => '2017-12-03 11:02:13',
            ),
            10 => 
            array (
                'id' => 438,
                'name' => 'auth',
                'namespace' => 'email',
                'value' => '1',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 0,
                'created_at' => NULL,
                'updated_at' => '2017-12-03 11:02:13',
            ),
            11 => 
            array (
                'id' => 439,
                'name' => 'user',
                'namespace' => 'email',
                'value' => '',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 0,
                'created_at' => NULL,
                'updated_at' => '2017-12-03 11:02:13',
            ),
            12 => 
            array (
                'id' => 440,
                'name' => 'password',
                'namespace' => 'email',
                'value' => '',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 0,
                'created_at' => NULL,
                'updated_at' => '2017-12-03 11:02:13',
            ),
            13 => 
            array (
                'id' => 441,
                'name' => 'manage.request',
                'namespace' => 'safe',
                'value' => '1',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 1,
                'created_at' => NULL,
                'updated_at' => '2017-12-06 07:46:56',
            ),
            14 => 
            array (
                'id' => 442,
                'name' => 'manage.operation',
                'namespace' => 'safe',
                'value' => '1',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 1,
                'created_at' => NULL,
                'updated_at' => '2017-12-06 07:46:56',
            ),
            15 => 
            array (
                'id' => 443,
                'name' => 'manage.login.ips',
                'namespace' => 'safe',
                'value' => '',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 1,
                'created_at' => NULL,
                'updated_at' => '2017-12-06 07:46:56',
            ),
            16 => 
            array (
                'id' => 444,
                'name' => 'manage.login.ctime',
                'namespace' => 'safe',
                'value' => '60',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 1,
                'created_at' => NULL,
                'updated_at' => '2017-12-06 07:46:56',
            ),
            17 => 
            array (
                'id' => 445,
                'name' => 'host',
                'namespace' => 'ftp',
                'value' => '',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 0,
                'created_at' => NULL,
                'updated_at' => '2017-12-03 16:47:46',
            ),
            18 => 
            array (
                'id' => 446,
                'name' => 'port',
                'namespace' => 'ftp',
                'value' => '21',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 0,
                'created_at' => NULL,
                'updated_at' => '2017-12-03 16:47:46',
            ),
            19 => 
            array (
                'id' => 447,
                'name' => 'username',
                'namespace' => 'ftp',
                'value' => '',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 0,
                'created_at' => NULL,
                'updated_at' => '2017-12-03 16:47:46',
            ),
            20 => 
            array (
                'id' => 448,
                'name' => 'password',
                'namespace' => 'ftp',
                'value' => '',
                'vtype' => 'string',
                'desc' => '',
                'issystem' => 0,
                'created_at' => NULL,
                'updated_at' => '2017-12-03 16:47:46',
            ),
        ));
        
        
    }
}