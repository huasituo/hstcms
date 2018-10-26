<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Console\Commands;

use Huasituo\Hstcms\Hstcms;
use Huasituo\Hstcms\Model\CommonRoleModel;
use Huasituo\Hstcms\Model\CommonRoleUriModel;
use Huasituo\Hstcms\Model\ManageMenuModel;
use Huasituo\Hstcms\Model\ManageUserModel;
use Huasituo\Hstcms\Model\ManageModulesModel;
use Huasituo\Hstcms\Model\CommonConfigModel;
use Huasituo\Hstcms\Model\ApiModel;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class HstcmsCacheCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'hstcms:cache {--t=null} {--v=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cache';

    /**
     * @var Hstcms
     */
    protected $hstcms;

    /**
     * Create a new command instance.
     *
     * @param Hstcms $hstcms
     */
    public function __construct(Hstcms $hstcms)
    {
        parent::__construct();

        $this->hstcms = $hstcms;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        CommonRoleModel::setCache('manage', false);
        $this->info('Common Role Success');
        CommonRoleUriModel::setCache('manage', false);
        $this->info('Common Role Uri Success');
        ManageMenuModel::setCache('manage', false);
        $this->info('Manage Menu Success');
        ManageUserModel::setCache(false);
        $this->info('Manage User Success');
        ManageModulesModel::setCache(false);
        $this->info('Modules Success');
        CommonConfigModel::setAllCache();
        $this->info('Config Success');
        ApiModel::setCache();
        $this->info('Api Success');
        $this->call('hook:cache', [
            '--p'=>'all'
        ]);
        hstcms_hook('s_cache');
        $this->info('Success');
    }
}
