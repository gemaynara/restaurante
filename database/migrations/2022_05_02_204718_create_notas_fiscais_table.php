<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasFiscaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas_fiscais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->on('empresas')->references('id');

            $table->unsignedBigInteger('fornecedor_id');
            $table->foreign('fornecedor_id')->on('fornecedores')->references('id');

            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->on('users')->references('id');

            $table->integer('numero_nota');
            $table->string('natureza');
            $table->decimal('valor_total');
            $table->decimal('valor_frete')->default(0.00)->nullable();
            $table->decimal('valor_desconto')->default(0.00)->nullable();
            $table->string('situacao')->default('LANÇADA');
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
        Schema::dropIfExists('notas_fiscais');
    }
}
