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

            $table->string('tipo_pedido', 20)->default('mesa');
            $table->integer('numero_pedido');
            $table->integer('numero_pessoas')->default(1);
            $table->string('nome',200);
            $table->string('telefone',15);
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
