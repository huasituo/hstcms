<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommonRoleUriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_role_uri', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->string('name')->nullable()->comment(hst_lang('hstcms::public.name'));
            $table->string('ename')->nullable()->comment(hst_lang('hstcms::public.ename'));
            $table->string('uri')->nullable()->comment('URI'.hst_lang('hstcms::public.name'));
            $table->string('parent')->default('')->comment(hst_lang('hstcms::public.parent'));
            $table->string('module', 30)->default('manage')->comment(hst_lang('hstcms::public.module'));
            $table->text('remark')->nullable()->comment(hst_lang('hstcms::public.remark'));
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('common_role_uri');
    }
}
