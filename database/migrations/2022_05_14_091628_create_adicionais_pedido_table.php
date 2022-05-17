<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdicionaisPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adicionais_pedido', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->on('empresas')->references('id');

            $table->unsignedBigInteger('produto_pedido_id');
            $table->foreign('produto_pedido_id')->on('produtos_pedido')->references('id');

            $table->unsignedBigInteger('adicional_id');
            $table->foreign('adicional_id')->on('adicionais_cardapio')->references('id');

            $table->integer('quantidade')->default(1);
            $table->decimal('valor_unitario')->default(0.00);
            $table->decimal('subtotal')->default(0.00);

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
        Schema::dropIfExists('adicionais_pedido');
    }
}
