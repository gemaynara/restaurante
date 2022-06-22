<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->on('empresas')->references('id');

            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->foreign('usuario_id')->on('users')->references('id');

            $table->unsignedBigInteger('operador_id')->nullable();
            $table->foreign('operador_id')->on('users')->references('id');

            $table->unsignedBigInteger('endereco_id')->nullable();
            $table->foreign('endereco_id')->on('enderecos')->references('id');

            $table->unsignedBigInteger('mesa_id')->nullable();
            $table->foreign('mesa_id')->on('mesas')->references('id');

            $table->string('tipo_pedido', 20)->default('salao');
            $table->integer('numero_pedido');
            $table->integer('numero_pessoas')->default(1);
            $table->string('nome',200)->nullable();
            $table->string('cpf',14)->nullable();
            $table->string('email')->nullable();
            $table->decimal('subtotal', 11,2)->default(0.00);
            $table->decimal('adicionais', 11,2)->default(0.00);
            $table->decimal('taxa', 11,2)->default(0.00);
            $table->decimal('desconto', 11,2)->default(0.00);
            $table->decimal('total', 11,2)->default(0.00);
            $table->string('status_pedido')->default('Pedido Aberto');
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
        Schema::dropIfExists('pedidos');
    }
}
