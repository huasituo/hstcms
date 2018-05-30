<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommonConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('common_config', function (Blueprint $table) 
        {
            $table->increments('id')->comment('ID');
            $table->string('name', 30)->default('')->comment(hst_lang('hstcms::public.name'));
            $table->string('namespace', 30)->default('')->comment(hst_lang('hstcms::public.namespace'));
            $table->text('value', 255)->comment(hst_lang('hstcms::public.cvalue'));
            $table->enum('vtype', ['string','array','object'])->default('string')->nullable();
            $table->text('desc', 255)->comment(hst_lang('hstcms::public.desc'));
            $table->tinyInteger('issystem', false)->default(0)->comment(hst_lang('hstcms::public.issystem'));
            $table->unique(['name','namespace']);
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
        Schema::drop('common_config');
    }
}
