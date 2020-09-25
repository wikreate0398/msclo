<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvantagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advantages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ru');
            $table->string('name_en')->nullable();
            $table->text('description_ru');
            $table->text('description_en')->nullable();
            $table->string('image')->nullable();
            $table->boolean('view')->default(true);
            $table->integer('page_up')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advantages');
    }
}
