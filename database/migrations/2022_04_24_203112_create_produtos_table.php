<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->on('empresas')->references('id');

            $table->unsignedBigInteger('categoria_produto_id');
            $table->foreign('categoria_produto_id')->on('categoria_produtos')->references('id');

            $table->string('codigo', 20)->nullable();
            $table->string('nome', 50);
            $table->string('descricao', 200)->nullable();
            $table->char('unidade', 3);
            $table->decimal('estoque', 11,3)->default(0);
            $table->integer('estoque_min')->default(0);
            $table->integer('estoque_max')->default(0);
            $table->string('lote')->nullable();
            $table->decimal('valor', 11,2)->default(0.00)->nullable();
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
        Schema::dropIfExists('produtos');
    }
}
