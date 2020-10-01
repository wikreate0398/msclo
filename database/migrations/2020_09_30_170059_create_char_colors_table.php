<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chars', function (Blueprint $table) {
            $table->boolean('is_color');
        });
        Schema::create('char_colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('char_id')->unsigned();
            $table->foreign('char_id')->references('id')->on('chars')->onDelete('cascade');
            $table->string('color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('char_colors');
        Schema::table('chars', function (Blueprint $table) {
            $table->dropColumn('is_color');
        });
    }
}
