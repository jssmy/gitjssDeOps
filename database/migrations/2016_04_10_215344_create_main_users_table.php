<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('main_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider_id')->unique()->nullable();
            $table->enum('provider',['google'])->nullable();
            $table->string('username',50)->nullable();
            $table->string('name',50)->nullable();
            $table->string('token')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->boolean('github')->default(0);
            $table->boolean('trello')->default(0);
            $table->boolean('slack')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('main_users');
    }
}
