<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharsColorTable extends Migration
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
        Schema::create('chars_color', function (Blueprint $table) {
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
        Schema::dropIfExists('chars_color');
        Schema::table('chars', function (Blueprint $table) {
            $table->dropColumn('is_color');
        });
    }
}
