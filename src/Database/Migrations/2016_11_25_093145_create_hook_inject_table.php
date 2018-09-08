<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHookInjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('hook_inject', function (Blueprint $table)
        {
            $table->increments('id')->comment('ID');
            $table->string('hook_name', 50)->default('')->comment(trans('hstcms::hook.name'));
            $table->string('alias', 100)->default('')->comment(trans('hstcms::hook.alias'));
            $table->string('files', 150)->default('')->comment(trans('hstcms::hook.files'));
            $table->string('class', 50)->default('root')->comment(trans('hstcms::hook.class'));
            $table->string('fun', 50)->default('root')->comment(trans('hstcms::hook.fun'));
            $table->text('description', 255)->comment(trans('hstcms::hook.description'));
            $table->tinyInteger('issystem', false)->default(0)->comment(trans('hstcms::hook.issystem'));
            $table->integer('times')->nullable()->comment(trans('hstcms::public.times'));
            $table->unique(['hook_name', 'alias']);
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
        Schema::drop('hook_inject');
    }
}
