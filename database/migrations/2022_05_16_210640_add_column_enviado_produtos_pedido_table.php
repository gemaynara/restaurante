<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEnviadoProdutosPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtos_pedido', function (Blueprint $table) {
            $table->char('enviado')->default('N')->after('observacoes');
            $table->char('produzido')->default('N')->after('enviado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos_pedido', function (Blueprint $table) {
            $table->dropColumn('enviado');
            $table->dropColumn('produzido');
        });
    }
}
