<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id')->default(0);
            $table->string('type');
            $table->string('name_ru');
            $table->string('name_en');
            $table->boolean('used_cart');
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
        Schema::dropIfExists('chars');
    }
}
