<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name_ru');
            $table->text('description_ru');
            $table->string('file');
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
        Schema::dropIfExists('provider_files');
    }
}
