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
            $table->string('nm_primeiro_nome');
            $table->string('nm_sobrenome');
            $table->string('nm_email');
            $table->string('img_usuario');
            $table->integer('cd_convidado_por');
            $table->integer('cd_fila_usuario');
            $table->integer('cd_sala_santos')->unsigned();
            $table->integer('cd_sala_sao_paulo')->unsigned();
            $table->timestamps();
            $table->foreign('cd_sala_santos')->references('cd_sala_santos')->on('tb_sala_santos');
            $table->foreign('cd_sala_sao_paulo')->references('cd_sala_sao_paulo')->on('tb_sala_sao_paulo');
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
