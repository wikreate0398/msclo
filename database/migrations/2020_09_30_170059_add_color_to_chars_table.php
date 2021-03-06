<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColorToCharsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('char_colors');
        Schema::dropIfExists('products_colors');
        Schema::table('chars', function (Blueprint $table) {
            //если хочешь синхронизировать таблицу, то запусти миграцию так, а потом раскоментируй строчку ниже
            // $table->boolean('is_color');
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
        Schema::table('chars', function (Blueprint $table) {
            $table->dropColumn('is_color');
            $table->dropColumn('color');
        });
    }
}
