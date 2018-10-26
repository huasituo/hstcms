<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommonApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('common_api', function (Blueprint $table) 
        {
            $table->increments('id')->comment('ID');
            $table->string('name')->nullable()->comment(hst_lang('hstcms::public.name'));
            $table->integer('addtimes')->nullable()->comment(hst_lang('hstcms::public.times'));
            $table->integer('edittimes')->nullable()->comment(hst_lang('hstcms::public.times'));
            $table->tinyInteger('status', false)->default(0)->nullable()->comment(hst_lang('hstcms::public.status'));
            $table->string('appid')->nullable()->comment();
            $table->string('secret')->nullable()->comment();
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
        Schema::drop('common_api');
    }
}
