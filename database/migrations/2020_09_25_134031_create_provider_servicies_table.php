<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderServiciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id');
            $table->string('type');
            $table->string('name_ru');
            $table->string('name_en');
            $table->boolean('used_cart')->default(0);
            $table->boolean('view_filter')->default(0);
            $table->boolean('view')->default(true);
            $table->integer('page_up')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers_services');
    }
}
