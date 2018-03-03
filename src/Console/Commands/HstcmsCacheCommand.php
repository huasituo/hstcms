<?php

namespace Huasituo\Hstcms\Console\Commands;

use Huasituo\Hstcms\Hstcms;
use Huasituo\Hstcms\Model\CommonRoleModel;
use Huasituo\Hstcms\Model\CommonRoleUriModel;
use Huasituo\Hstcms\Model\ManageMenuModel;
use Huasituo\Hstcms\Model\ManageUserModel;

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
    protected $name = 'hstcms:cache';

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
        CommonRoleUriModel::setCache('manage', false);
        ManageMenuModel::setCache('manage', false);
        ManageUserModel::setCache(false);
        if(config('hook.version')) {
            hst_hook('s_cache');
        }
        $this->info('Success');
    }
}
