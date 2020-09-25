<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ru');
            $table->string('name_en');
            $table->text('description');
            $table->string('icon');
            $table->string('route');
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
        Schema::dropIfExists('profile_menu');
    }
}
