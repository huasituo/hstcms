<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommonFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_form', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->string('name')->nullable()->comment(hst_lang('hstcms::public.name'));
            $table->text('setting')->comment();
            $table->string('module', 30)->default('site')->comment(hst_lang('hstcms::public.module'));
            $table->string('table', 30)->comment(hst_lang('hstcms::public.table'));
            $table->integer('relatedid')->nullable()->comment();
            $table->integer('times')->nullable()->comment(hst_lang('hstcms::public.times'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('common_form');
    }
}
