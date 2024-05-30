<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstabelecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estabelecimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('nome_empresarial')->nullable();
            $table->string('endereco')->nullable();
            $table->string('telefone')->nullable();
            $table->string('cnes')->nullable(); // Assuming 'cnes' is a string
            $table->string('natureza_juridica')->nullable();
            $table->string('gestao')->nullable();
            $table->string('subtipo')->default('OUTROS');
            $table->string('cnpj');
            $table->string('dependencia')->default('INDIVIDUAL');
            $table->timestamps();
        });


        Schema::table('guias', function (Blueprint $table) {
            $table->dropForeign('guias_id_contratado_executante_foreign');

            $table->foreign('id_contratado_executante')->references('id')->on('estabelecimentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estabelecimentos');

        Schema::table('guias', function (Blueprint $table) {
            $table->dropForeign(['id_contratado_executante']);


            $table->foreign('id_contratado_executante')->references('id')->on('unidades');
        });
    }
}

