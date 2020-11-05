<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_usuario', function (Blueprint $table) {
            $table->increments('cd_usuario');
            $table->string('nm_usuario');
            $table->string('cd_senha');
            $table->string('nm_primeiro_nome')->nullable();
            $table->string('nm_sobrenome')->nullable();
            $table->string('nm_email')->nullable();
            $table->string('img_usuario')->nullable();
            $table->integer('cd_convidado_por')->nullable();
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
        Schema::dropIfExists('tb_usuario');
    }
}
