<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControleCaixaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controle_caixa', function (Blueprint $table) {
            $table->id();
            $table->decimal('saldo_anterior', 11,2)->default(0.00);
            $table->decimal('valor_inicial', 11,2);
            $table->decimal('entradas', 11,2)->default(0.00);
            $table->decimal('saidas', 11,2)->default(0.00);
            $table->decimal('valor_final', 11,2)->default(0.00);
            $table->decimal('saldo_quebra', 11,2)->default(0.00);
            $table->decimal('saldo_falta', 11,2)->default(0.00);
            $table->char('status')->default('A');
            $table->string('observacoes',300)->nullable();
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
        Schema::dropIfExists('controle_caixa');
    }
}
