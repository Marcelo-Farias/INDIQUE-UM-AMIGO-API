<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaIndicacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicacoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome')->nullable(false);
            $table->string('cpf')->unique()->nullable(false);
            $table->string('telefone');
            $table->string('email');
            $table->bigInteger('status_id');

            $table->foreign('status_id')->references('id')->on('statusDasIndicacoes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicacoes');
    }
}
