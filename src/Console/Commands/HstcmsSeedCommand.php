<?php

namespace Huasituo\Hstcms\Console\Commands;

use Huasituo\Hstcms\Hstcms;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class HstcmsSeedCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'hstcms:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with records for a specific or all hstcms';

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
        $seeder = ['ManageUser', 'CommonConfig', 'CommonRole', 'CommonRoleUri', 'ManageMenu'];
        if($seeder) {
            if($this->option('table')) {
                if(in_array($this->option('table'), $seeder)) {
                    $fullPath = 'Huasituo\Hstcms\Database\Seeds\\'.$this->option('table').'TableSeeder';
                    $this->seed($fullPath, $this->option('table'));
                }
            } else {
                foreach ($seeder as $key => $value) {
                    $fullPath = 'Huasituo\Hstcms\Database\Seeds\\'.$value.'TableSeeder';
                    $this->seed($fullPath, $value);
                }
            }
        }
    }

    /**
     * Seed the specific module.
     *
     * @param string $module
     *
     * @return array
     */
    protected function seed($fullPath, $table)
    {
         if (class_exists($fullPath)) {
            if ($this->option('class')) {
                $params['--class'] = $this->option('class');
            } else {
                $params['--class'] = $fullPath;
            }
            if ($option = $this->option('database')) {
                $params['--database'] = $option;
            }
            if ($option = $this->option('force')) {
                $params['--force'] = $option;
            }
            $this->call('db:seed', $params);
            $this->info('Seed: '. $table);
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['table', null, InputOption::VALUE_OPTIONAL, 'The table name of the hstcms\'s root seeder.'],
            ['class', null, InputOption::VALUE_OPTIONAL, 'The class name of the hstcms\'s root seeder.'],
            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to seed.'],
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run while in production.'],
        ];
    }
}
