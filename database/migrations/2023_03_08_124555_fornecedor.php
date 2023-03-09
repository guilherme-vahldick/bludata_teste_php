<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fornecedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('tipo_pessoa')->default('F');

            $table->string('nome');

            $table->unsignedBigInteger('empresa_id')->index();
            $table->foreign('empresa_id')->references('id')->on('empresa');
            
            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('rg')->nullable();
            $table->date('data_nascimento')->nullable();

            $table->longText('telefone')->nullable();

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
        Schema::dropIfExists('fornecedor');
    }
}
