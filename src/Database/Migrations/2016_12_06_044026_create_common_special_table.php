<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommonSpecialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_special', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->string('name')->nullable()->comment(hst_lang('hstcms::public.name'));
            $table->tinyInteger('isopen', false)->default(0)->nullable()->comment(hst_lang('hstcms::public.status'));
            $table->tinyInteger('header', false)->default(0)->nullable()->comment();
            $table->tinyInteger('footer', false)->default(0)->nullable()->comment();
            $table->string('title')->nullable()->comment();
            $table->string('keywords')->nullable()->comment();
            $table->string('description')->nullable()->comment();
            $table->string('domain')->nullable()->comment();
            $table->string('style')->nullable()->comment();
            $table->string('dir')->nullable()->comment();
            $table->string('module')->nullable()->comment();
            $table->text('content')->nullable()->comment();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('common_special');
    }
}
