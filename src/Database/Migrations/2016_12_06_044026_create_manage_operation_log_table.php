<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManageOperationLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_operation_log', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->string('uid')->nullable()->comment('UID');
            $table->string('username')->nullable()->comment(hst_lang('hstcms::public.username'));
            $table->integer('times')->nullable()->comment(hst_lang('hstcms::public.times'));
            $table->tinyInteger('status', false)->default(0)->nullable()->comment(hst_lang('hstcms::public.review.status'));
            $table->string('suid')->nullable()->comment(hst_lang('hstcms::public.review.uid'));
            $table->string('susername')->nullable()->comment(hst_lang('hstcms::public.review.username'));
            $table->integer('stimes')->nullable()->comment(hst_lang('hstcms::public.review.times'));
            $table->ipAddress('ip')->nullable()->comment('IP');
            $table->string('port', 10)->nullable()->comment('IP'.hst_lang('hstcms::public.port'));
            $table->string('platform')->nullable()->comment(hst_lang('hstcms::public.operating.system'));
            $table->string('browser')->nullable()->comment(hst_lang('hstcms::public.browser'));
            $table->text('olddata')->nullable()->comment(hst_lang('hstcms::public.olddata'));
            $table->text('newdata')->nullable()->comment(hst_lang('hstcms::public.newdata'));
            $table->text('change')->nullable()->comment(hst_lang('hstcms::public.change'));
            $table->text('remark')->nullable()->comment(hst_lang('hstcms::public.remark'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('manage_operation_log');
    }
}
