<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachs', function (Blueprint $table) {
            $table->increments('aid')->comment('AID');
            $table->string('name')->nullable()->comment(hst_lang('hstcms::public.name'));
            $table->string('type')->nullable()->comment();
            $table->string('path')->nullable()->comment();
            $table->string('app')->nullable()->comment();
            $table->string('descrip')->nullable()->comment();
            $table->string('disk')->nullable()->comment();
            $table->tinyInteger('ifthumb', false)->nullable(0)->comment();
            $table->integer('app_id')->nullable()->comment('appid');
            $table->integer('size')->nullable()->comment('size');
            $table->integer('created_userid')->nullable()->comment('UID');
            $table->integer('created_time')->nullable()->comment(hst_lang('hstcms::public.times'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attachs');
    }
}
