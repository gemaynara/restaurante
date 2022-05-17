<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id');

            $table->string('tipo', 50)->nullable();
            $table->string('endereco', 200)->nullable();
            $table->string('complemento', 200)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('cep', 9)->nullable();
            $table->string('cidade', 50)->nullable();
            $table->string('estado', 2)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('enderecos');
    }
}
