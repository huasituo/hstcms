<?php

namespace Huasituo\Hstcms\Console\Commands;

use Huasituo\Hstcms\Hstcms;

use Illuminate\Console\Command;

class HstcmsInstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'hstcms:install {--data=true}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hstcms Install';

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
        $boolData = $this->option('data');
        $this->call('migrate', [
            '--force' => true
        ]);
        $this->call('db:seed');
        $seedListsClass = [
            'CommonConfig', 'CommonRole', 'ManageMenu', 'CommonRoleUri'
        ];
        if($seedListsClass) {
            foreach ($seedListsClass as $class) {
                $this->call('db:seed', [
                    '--class' => $class . 'TableSeeder'
                ]);
            }
        }
        //Set up test data in the database
        if (!empty($boolData))
        {
            $seedListClass = [
                //'Article'
            ];
            if($seedListClass) {
                foreach ($seedListClass as $class) {
                    $this->call('db:seed', [
                        '--class' => $class . 'TableSeeder'
                    ]);
                }
            }
        }
    }
}
