<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->on('users')->references('id');

            $table->string('identificador')->nullable();
            $table->string('tipo_identificacao')->nullable(); //pedido, nota, pagamento
            $table->decimal('valor_total', 11,2);
            $table->decimal('valor_pago', 11,2);
            $table->decimal('valor_troco', 11,2)->nullable();
            $table->string('tipo_movimentacao')->nullable(); //entrada ou saida
            $table->string('forma_pagamento')->nullable();
            $table->string('descricao', 300)->nullable();
            $table->integer('empresa_id')->nullable();
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
        Schema::dropIfExists('movimentacoes');
    }
}
