<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('url');
            $table->bigInteger('provider_id')->unsigned()->nullable();
            $table->foreign('provider_id')->references('id')->on('users');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('name_ru');
            $table->string('name_en');
            $table->text('description_ru')->nullable();
            $table->text('description_en')->nullable();
            $table->text('text_en')->nullable();
            $table->text('text_ru')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('price')->nullable();
            $table->boolean('is_new')->default(true);
            $table->boolean('view')->default(true);
            $table->integer('page_up')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
