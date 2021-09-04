<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaStatusDasIndicacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statusDasIndicacoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            // 'descricao'  pode ter apenas os valores '1.INICIADA', '2.EM PROCESSO' ou '3.FINALIZADA'.
            $table->string('descricao')->default('1.INICIADA')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statusDasIndicacoes');
    }
}
