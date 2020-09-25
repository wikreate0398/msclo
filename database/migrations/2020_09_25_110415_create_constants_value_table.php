<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstantsValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constants_value', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lang');
            $table->bigInteger('constant_id')->unsigned();
            $table->foreign('constant_id')->references('id')->on('constants')->onDelete('cascade')->onUpdate('cascade');
            $table->text('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('constants_value');
    }
}
