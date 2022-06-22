<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentacaoEstoqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentacao_estoque', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->on('users')->references('id');

            $table->string('identificador')->nullable();
            $table->decimal('saldo_anterior', 11,3);
            $table->decimal('saldo_movimentado', 11,3);
            $table->decimal('saldo_atualizado', 11,3);
            $table->string('tipo_movimentacao')->nullable(); //entrada ou saida
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
        Schema::dropIfExists('movimentacao_estoque');
    }
}
