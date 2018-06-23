<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManageLoginLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('manage_login_log', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->string('uid')->nullable()->comment('UID');
            $table->string('username')->nullable()->comment(hst_lang('hstcms::public.username'));
            $table->integer('times')->nullable()->comment(hst_lang('hstcms::public.times'));
            $table->text('remark')->nullable()->comment(hst_lang('hstcms::public.remark'));
            $table->ipAddress('ip')->nullable()->comment('IP');
            $table->string('port', 10)->nullable()->comment('IP'.hst_lang('hstcms::public.port'));
            $table->string('platform')->nullable()->comment(hst_lang('hstcms::public.username'));
            $table->string('browser')->nullable()->comment(hst_lang('hstcms::public.username'));
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
        Schema::drop('manage_login_log');
    }
}
