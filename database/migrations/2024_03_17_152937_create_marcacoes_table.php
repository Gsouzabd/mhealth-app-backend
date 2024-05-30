<?php

use App\Enums\MarcacaoTipoRecorrencia;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarcacoesTable extends Migration
{
    public function up()
    {
        Schema::create('marcacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_funcionario');
            $table->unsignedBigInteger('id_especialidade');
            $table->unsignedBigInteger('convenio');
            $table->unsignedBigInteger('unidade');
            $table->time('horario'); // Armazena apenas a hora
            $table->date('data_inicial'); // Armazena apenas a data
            $table->integer('duracao');
            $table->boolean('recorrencia'); // Verdadeiro ou falso
            $table->enum('tipoRecorrencia', array_column(MarcacaoTipoRecorrencia::cases(), 'name'))->nullable(); // S, Q, M
            $table->integer('vezesRecorrencia')->nullable();
            $table->unsignedBigInteger('marcadoPor');

            $table->timestamps();

            // Adicionando índices
            $table->index('id_paciente');
            $table->index('id_funcionario');
            $table->index('id_especialidade');
            $table->index('marcadoPor');
            $table->index('unidade');
            $table->index('convenio');

            $table->foreign('id_paciente')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('id_funcionario')->references('id')->on('funcionarios')->onDelete('cascade');
            $table->foreign('marcadoPor')->references('id')->on('funcionarios');
            $table->foreign('convenio')->references('id')->on('convenios')->onDelete('cascade');
            $table->foreign('unidade')->references('id')->on('unidades')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('marcacoes');
    }
}
