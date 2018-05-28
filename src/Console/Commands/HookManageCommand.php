<?php 

namespace Huasituo\Hstcms\Console\Commands;

use Huasituo\Hstcms\Model\HookModel;
use Huasituo\Hstcms\Model\HookInjectModel;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class HookManageCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'hook:manage';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hook Manage';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $slug = $this->argument('slug');
        $value = $this->argument('value');
        if($slug && $value) {
            if($slug == 'module') {
                HookModel::del('', $value);
            } else {
                HookModel::del($value);
            }
            $this->call('hook:cache');
            $this->info('Delete Success');
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['slug', InputArgument::REQUIRED, 'Hook slug.'],
            ['value', InputArgument::REQUIRED, 'Hook value.']
        ];
    }
}
