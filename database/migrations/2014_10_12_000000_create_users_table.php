<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function($table)
        {
            $table->id();
            $table->string('name')->comment('Nombre del rol del usuario');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->string('slug');
            $table->foreignId('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->string('rut')->nullable();
            $table->string('birthday')->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('user_social_account', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('provider');
            $table->string('provider_uid');
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
        Schema::dropIfExists('roles');
        Schema::dropIfExists('user_social_account');
    }
}
