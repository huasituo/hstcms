<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('hook', function (Blueprint $table)
        {
            $table->string('name', 30)->default('')->comment(trans('hstcms::hook.name'));
            $table->string('module', 30)->default('manage')->comment(trans('hstcms::hook.module'));
            $table->text('description', 255)->comment(trans('hstcms::hook.description'));
            $table->tinyInteger('issystem', false)->default(0)->comment(trans('hstcms::hook.issystem'));
            $table->integer('times')->nullable()->comment(trans('hstcms::manage.times'));
            $table->text('document', 255)->comment(trans('hstcms::hook.document'));
            $table->primary('name');
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
        Schema::drop('hook');
    }
}
