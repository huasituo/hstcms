<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Install;

use Huasituo\Hstcms\Http\Controllers\BasicController;
use Huasituo\Hstcms\Model\ManageUserModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use Validator;

class InstallController extends BasicController
{
    public $fileLockPath;
    public $installConfig = array();

    public function __construct()
    {
        error_reporting(0);
        $this->fileLockPath = base_path('hstcms.install.lck');
        $this->installConfig = [
            'n'=>'HSTCMS',
            'version'=>config('hstcms.version'),
            'name'=>config('hstcms.name'),
            'title'=>config('hstcms.name'),
            'keywords'=>config('hstcms.name'),
            'description'=>config('hstcms.name'),
            'site_url' => hst_domain(),
            'db_host' => 'localhost',
            'db_database' => 'hstcms',
            'db_username' => 'root',
            'db_password' => '',
            'username' => 'admin'
        ];
        if (file_exists($this->fileLockPath)) {
            dd(hst_lang('hstcms::install.install.already').$this->installConfig['n'].$this->installConfig['version'].'，'.hst_lang('hstcms::install.install.one'));
        } else {
            dd(hst_lang('hstcms::install.install.tips'));
        }
    }

    public function index(Request $request)
    {
        if ($request->get('step')) {
            $step = Crypt::decrypt($request->get('step'));
        } else {
            $step = 1;
        }
        $data = [];
        switch ($step) {
            case 1:
                $view = 'install.step1';
                break;
            case 2:
                $error = false;
                $limitEnv = [
                    'min' => [
                        'php_version' => '5.6',
                        'gd' => '2.0',
                        'disk_space' => '200M'
                    ],
                    'perfect' => [
                        'php_version' => '5.6',
                        'gd' => '2.0',
                        'disk_space' => hst_lang('hstcms::install.unlimited')
                    ]
                ];
                $check_gd = function_exists ( 'gd_info' ) ? gd_info () : array (); 
                $check_gd = $check_gd ['GD Version'] ? $check_gd ['GD Version'] : 0;
                $env = [
                    'OS' => PHP_OS,
                    'php_version' => PHP_VERSION,
                    'file_upload' => @ini_get('file_uploads') ? @ini_get('upload_max_filesize') : 'unknow',
                    'disk_space' => floor(disk_free_space(base_path()) / (1024*1024)).'M',
                    'gd' => $check_gd
                ];
                $fileRW = [
                    [
                        'path' => DIRECTORY_SEPARATOR . 'bootstrap',
                        'power' => 'w',
                        'type' => 'dir'
                    ],
                    [
                        'path' => DIRECTORY_SEPARATOR . 'storage',
                        'power' => 'w',
                        'type' => 'dir'
                    ],
                    [
                        'path' => DIRECTORY_SEPARATOR . 'resources',
                        'power' => 'w',
                        'type' => 'dir'
                    ],
                    [
                        'path' => DIRECTORY_SEPARATOR . 'public',
                        'power' => 'w',
                        'type' => 'dir'
                    ],
                    [
                        'path' => '.env',
                        'power' => 'w',
                        'type' => 'file'
                    ]
                ];

                foreach ($fileRW as $key => $value){
                    if ($value['type'] == 'dir'){
                        if (is_dir(base_path($value['path']))) {
                            if (is_writable(base_path($value['path']))) {
                                $fileRW[$key]['result'] = 1;
                            } else {
                                $fileRW[$key]['result'] = 0;
                                $error = true;
                            }
                        } else {
                            $fileRW[$key]['result'] = -1;
                            $error = true;
                        }
                    } else {
                        if (file_exists(base_path($value['path']))) {
                            if (is_writable(base_path($value['path']))) {
                                $fileRW[$key]['result'] = 1;
                            } else {
                                $fileRW[$key]['result'] = 0;
                                $error = true;
                            }
                        } else {
                            $fileRW[$key]['result'] = -1;
                            $error = true;
                        }
                    }

                }

                $needExtension = [
                    'curl', 'gd', 'iconv', 'mbstring', 'mcrypt', 'mysqli', 'mysqlnd', 'PDO', 'pdo_mysql', 'openssl', 'fileinfo'
                ];
                $functionArr = [];
                $localExtension = get_loaded_extensions();
                foreach ($needExtension as $key => $extension){
                    $functionArr[$key]['extension'] = $extension;
                    $functionArr[$key]['need'] = 'y';
                    if (!in_array($extension, $localExtension)) {
                        if ($extension == 'mysqli' && in_array('mysqlnd', $localExtension) || $extension == 'mysqlnd' && in_array('mysqli', $localExtension)) {
                            $functionArr[$key]['support'] = 'y';
                        } else {
                            $functionArr[$key]['support'] = 'n';
                            $error = true;
                        }
                    } else {
                        $functionArr[$key]['support'] = 'y';
                    }
                }
                if ($env['php_version'] < $limitEnv['min']['php_version']){
                    $error = true;
                }
                if ($env['gd'] < $limitEnv['min']['gd']){
                    $error = true;
                }
                if (intval($env['disk_space']) < intval($limitEnv['min']['disk_space'])){
                    $error = true;
                }
                $data = [
                    'env' => $env,
                    'error' => $error,
                    'fileRW' => $fileRW,
                    'limitEnv' => $limitEnv,
                    'functionArr' => $functionArr
                ];
                $view = 'install.step2';
                break;
            case 3:
                $preData = [
                    'site_url' => $this->installConfig['site_url'],
                    'db_host' => $this->installConfig['db_host'],
                    'db_database' => $this->installConfig['db_database'],
                    'db_username' => $this->installConfig['db_username'],
                    'db_password' => $this->installConfig['db_password'],
                    'username' => $this->installConfig['username'],
                ];
                $data = [
                    'preData' => $preData
                ];
                $view = 'install.step3';
                break;
            case 4:
                $lockContent = env('APP_KEY');
                File::put($this->fileLockPath, $lockContent);
                Artisan::call('key:generate');
                $view = 'install.step4';
                break;
        }
        $data['name'] = $this->installConfig['name'];
        $data['n'] = $this->installConfig['n'];
        $data['v'] = $this->installConfig['v'];
        return view('hstcms::'.$view, $data);
    }
    
    public function checkDatabase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_url' => 'required|url',
            'db_host' => 'required|string',
            'db_database' => 'required|string',
            'db_username' => 'required|string',
            'db_password' => 'required|string',

            'username' => 'required|string',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
            //'is_data' => 'required'
        ],[
            'site_url.required'=>hst_lang('hstcms::install.site.url.empty'),
            'db_host.required'=> hst_lang('hstcms::install.db.host.empty'),
            'db_database.required' => hst_lang('hstcms::install.db.database.empty'),
            'db_username.required' => hst_lang('hstcms::install.db.username.empty'),
            'db_password.required' => hst_lang('hstcms::install.db.password.empty'),

            'username.required' => hst_lang('hstcms::install.username.empty'),
            'password.required' => hst_lang('hstcms::install.password.empty'),
            'confirm_password.required' => hst_lang('hstcms::install.db.confirm.password.empty'),

        ]);
        if ($validator->fails()) {
            return redirect('install?step=' . Crypt::encrypt(3))
                        ->withErrors($validator)
                        ->withInput();
        }
        set_time_limit(1800);
        $arrRequest = $request->all();
        Config::set('database.connections.mysql.host', $arrRequest['db_host']);
        Config::set('database.connections.mysql.database', $arrRequest['db_database']);
        Config::set('database.connections.mysql.username', $arrRequest['db_username']);
        Config::set('database.connections.mysql.password', $arrRequest['db_password']);
        $link = mysqli_connect($arrRequest['db_host'], $arrRequest['db_username'], $arrRequest['db_password']);
        if ($link) {
            if (!mysqli_select_db($arrRequest['db_database'], $link)) {
                $sql = "CREATE DATABASE `" . $arrRequest['db_database'] . "`";
                mysqli_query($link, $sql) or mysqli_error($link);
            }
            $configData = [
                'APP_ENV' => 'local',
                'APP_DEBUG' => 'true',
                'APP_KEY' => env('APP_KEY'),
                'APP_LOG_LEVEL' => 'debug',
                'APP_TIMEZONE' => 'UTC',
                'APP_LOCALE' => 'zh-CN',
                'APP_URL' => $arrRequest['site_url'],

                'DB_CONNECTION' => 'mysql',
                'DB_PORT' => '3306',
                'DB_HOST' => $arrRequest['db_host'],
                'DB_DATABASE' => $arrRequest['db_database'],
                'DB_USERNAME' => $arrRequest['db_username'],
                'DB_PASSWORD' => $arrRequest['db_password'],
                'DB_PREFIX' =>'hst_',

                'CACHE_DRIVER' => 'file',
                'SESSION_DRIVER' => 'file',
                'QUEUE_DRIVER' => 'sync',

                'REDIS_HOST' => '127.0.0.1',
                'REDIS_PASSWORD' => 'null',
                'REDIS_PORT' => 6379,

                'MAIL_DRIVER' => 'smtp',
                'MAIL_HOST' => 'mailtrap.io',
                'MAIL_PORT' => 25,
                'MAIL_USERNAME' => 'null',
                'MAIL_PASSWORD' => 'null',
                'MAIL_ENCRYPTION' => 'null'
            ];
            $data = '';
            foreach ($configData as $key => $value)
            {
                if (empty($data)) {
                    $data = $key . "=" . $value;
                } else {
                    $data = $data . "\n" . $key . '=' . $value ;
                }
            }
            $status = File::put(base_path('.env'), $data);
            if ($status) {
                Artisan::call('hstcms:install', [
                    '--data' => isset($arrRequest['is_data']) ? true : false
                ]);
                $status = DB::transaction(function() use ($arrRequest) {
                    hst_save_config('site', [
                        ['name'=>'url', 'value'=>$arrRequest['site_url'], 'issystem'=>1],
                        ['name'=>'debug', 'value'=>1, 'issystem'=>1]
                    ]);
                    $salt = hst_random(6);
                    ManageUserModel::insert([
                        'gid'=>99,
                        'status'=>0,
                        'username' => $arrRequest['username'],
                        'salt' => $salt,
                        'password' => hst_md5($arrRequest['password'], $salt)
                    ]);
                });
                if (!is_null($status)) {
                    $error = [
                        'install_fail' => hst_lang('hstcms::install.install.error')
                    ];
                }
            } else {
                $error = [
                    'install_fail' => hst_lang('hstcms::install.wite.config.error')
                ];
            }
        } else {
            $error = [
                'db_host' => hst_lang('hstcms::install.db.host.error'),
                'db_username' => hst_lang('hstcms::install.db.username.error'),
                'db_password' => hst_lang('hstcms::install.db.password.error'),
            ];
        }
        if (!empty($error)) {
            return back()->withErrors($error)->withInput();
        }
        return redirect('install?step=' . Crypt::encrypt(4));
    }
}
