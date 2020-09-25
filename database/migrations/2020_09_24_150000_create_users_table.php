<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type_id')->unsigned()->index();
            $table->foreign('type_id')->references('id')->on('user_types');
            $table->string('lang')->default('ru');
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('image');
            $table->string('phone2');
            $table->string('contact_email');
            $table->string('feedback_email');
            $table->string('site');
            $table->string('skype');
            $table->string('instagram');
            $table->string('vk');
            $table->string('office_address');
            $table->string('warehouse_address');
            $table->string('other_contacts');
            $table->string('note');
            $table->text('description');
            $table->text('text');
            $table->string('user_agent');
            $table->integer('active')->default(0);
            $table->integer('confirm')->default(0);
            $table->string('password');
            $table->string('confirm_hash');
            $table->rememberToken();
            $table->time('work_from')->nullable();
            $table->time('work_to')->nullable();
            $table->dateTime('last_entry')->nullable();
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
        Schema::dropIfExists('users');
    }
}
