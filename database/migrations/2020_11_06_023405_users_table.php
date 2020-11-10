<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->integer('cd_fila_usuario')->nullable();
            $table->integer('cd_sala_santos')->unsigned()->nullable();
            $table->integer('cd_sala_sao_paulo')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('cd_sala_santos')->references('cd_sala_santos')->on('tb_sala_santos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cd_sala_sao_paulo')->references('cd_sala_sao_paulo')->on('tb_sala_sao_paulo')->onDelete('cascade')->onUpdate('cascade');
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