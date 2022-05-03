<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosSaidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos_saidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('saida_id');
            $table->foreign('saida_id')->on('saidas')->references('id');

            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->on('produtos')->references('id');

            $table->decimal('quantidade', 11,3);
            $table->decimal('valor_unitario', 11,2);
            $table->decimal('subtotal', 11,2);
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
        Schema::dropIfExists('produtos_saidas');
    }
}
