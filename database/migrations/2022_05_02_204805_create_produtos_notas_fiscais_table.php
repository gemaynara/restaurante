<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosNotasFiscaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos_notas_fiscais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nota_fiscal_id');
            $table->foreign('nota_fiscal_id')->on('notas_fiscais')->references('id');

            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->on('produtos')->references('id');

            $table->decimal('quantidade', 11,3);
            $table->decimal('valor_unitario', 11,2);
            $table->decimal('subtotal', 11,2);
            $table->date('validade')->nullable();
            $table->string('lote')->nullable();
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
        Schema::dropIfExists('produtos_notas_fiscais');
    }
}
