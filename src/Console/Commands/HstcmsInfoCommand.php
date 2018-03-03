<?php 

namespace Huasituo\Hstcms\Console\Commands;

use Huasituo\Hstcms\Hstcms;

use Illuminate\Console\Command;

class HstcmsInfoCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'hstcms:info {--t=null}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hstcms Info';

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
        $t = $this->option('t');
        switch ($t) {
            case 'version':
                $this->info($this->hstcms->version());
                break;
            default:
                $this->info('Welcome to use Hstcms');
                $this->info('https://www.huasituo.com');
                break;
        }
    }
}
