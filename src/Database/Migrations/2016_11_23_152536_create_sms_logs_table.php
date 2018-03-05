<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sms_logs', function (Blueprint $table) 
        {
            $table->increments('id')->comment('ID');
            $table->string('type', 30)->default('')->comment(hst_lang('hstcms::public.type'));
            $table->integer('times')->nullable()->comment(hst_lang('hstcms::public.times'));
            $table->integer('uid')->nullable()->comment('UID');
            $table->string('note', 255)->default('')->comment(hst_lang('hstcms::public.note'));
            $table->string('code', 255)->default('')->comment(hst_lang('hstcms::public.code'));
            $table->string('sendnum', 255)->default('')->comment(hst_lang('hstcms::public.num'));
            $table->text('content', 255)->comment(hst_lang('hstcms::public.content'));
            $table->text('mobile', 255)->comment(hst_lang('hstcms::public.mobile'));
            $table->tinyInteger('status', false)->default(1)->comment(hst_lang('hstcms::public.status'));
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
        Schema::drop('sms_logs');
    }
}
