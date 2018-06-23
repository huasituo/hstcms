<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sms_code', function (Blueprint $table) 
        {
            $table->string('mobile', 30)->default('')->comment(hst_lang('hstcms::public.mobile'));
            $table->string('type', 30)->default('')->comment(hst_lang('hstcms::public.type'));
            $table->string('code', 30)->default('')->comment(hst_lang('hstcms::public.code'));
            $table->string('number', 30)->default('')->comment(hst_lang('hstcms::public.type'));
            $table->integer('expired_time')->nullable()->comment();
            $table->integer('create_time')->nullable()->comment(hst_lang('hstcms::public.times'));
            $table->unique(['mobile','type']);
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
        Schema::drop('sms_code');
    }
}
