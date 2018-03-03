<?php

namespace Huasituo\Hstcms\Database\Seeds;

use Illuminate\Database\Seeder;

class CommonRoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('common_role')->delete();
    }
}