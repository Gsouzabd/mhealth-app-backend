<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('dataHora');
            $table->unsignedBigInteger('id_funcionario');
            $table->unsignedBigInteger('id_especialidade');
            $table->unsignedBigInteger('unidadeId');
            $table->string('id_paciente');
            $table->timestamps();

            $table->foreign('id_paciente')->references('id')->on('pacientes');
            $table->foreign('id_funcionario')->references('id')->on('funcionarios');
            $table->foreign('id_especialidade')->references('id')->on('especialidades');
            $table->foreign('unidadeId')->references('id')->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas');
    }
}