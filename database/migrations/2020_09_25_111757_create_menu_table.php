<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ru');
            $table->string('name_en')->nullable();
            $table->string('url');
            $table->string('page_type');
            $table->boolean('let_alone')->default(false);
            $table->text('description_ru')->nullable();
            $table->text('description_en')->nullable();
            $table->text('text_ru')->nullable();
            $table->text('text_ro')->nullable();
            $table->text('text_en')->nullable();
            $table->string('seo_title_ru')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->text('seo_description_ru')->nullable();
            $table->text('seo_description_en')->nullable();
            $table->text('seo_keywords_ru')->nullable();
            $table->text('seo_keywords_en')->nullable();
            $table->string('image')->nullable();
            $table->boolean('view_top')->default(true);
            $table->boolean('view_bottom')->default(false);
            $table->boolean('toggle')->default(false);
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
        Schema::dropIfExists('menu');
    }
}
