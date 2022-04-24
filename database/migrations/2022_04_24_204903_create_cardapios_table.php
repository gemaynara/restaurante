<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardapiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cardapios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->on('empresas')->references('id');

            $table->unsignedBigInteger('categoria_cardapio_id');
            $table->foreign('categoria_cardapio_id')->on('categoria_cardapios')->references('id');

            $table->unsignedBigInteger('subcategoria_cardapio_id');
            $table->foreign('subcategoria_cardapio_id')->on('sub_categoria_cardapios')->references('id');

            $table->unsignedBigInteger('setor_id');
            $table->foreign('setor_id')->on('setores')->references('id');

            $table->string('nome', 50);
            $table->string('descricao', 200)->nullable();
            $table->string('imagem', 500)->nullable();
            $table->decimal('valor', 11,2);
            $table->string('medida', 10)->nullable();
            $table->integer('quantidade_servida')->default(1);
            $table->time('tempo_preparo');
            $table->integer('contador_pedidos')->default(0);
            $table->boolean('ativo')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cardapios');
    }
}
