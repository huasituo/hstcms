<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManageMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('manage_menu', function (Blueprint $table)
        {
            $table->increments('id')->comment('ID');
            $table->string('name', 30)->default('')->comment(hst_lang('hstcms::public.name'));
            $table->string('ename', 30)->default('')->comment(hst_lang('hstcms::public.ename'));
            $table->string('icon', 50)->default('')->comment(hst_lang('hstcms::public.icon'));
            $table->string('url')->default('')->comment('url');
            $table->tinyInteger('level', false)->default(0)->comment(hst_lang('hstcms::public.level'));
            $table->string('parent', 30)->default('root')->comment(hst_lang('hstcms::public.parent'));
            $table->string('parents', 30)->default('')->comment(hst_lang('hstcms::public.parents'));
            $table->string('module', 30)->default('manage')->comment(hst_lang('hstcms::public.module'));
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('manage_menu');
    }
}
