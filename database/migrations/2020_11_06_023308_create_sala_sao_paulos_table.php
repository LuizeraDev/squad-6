<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaSaoPaulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_sala_sao_paulo', function (Blueprint $table) {
            $table->increments('cd_sala_sao_paulo');
            $table->string('nm_sala')->unique();
            $table->string('img_sala')->nullable();
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
        Schema::dropIfExists('tb_sala_sao_paulo');
    }
}
