<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspecialidadesFuncionariosTable extends Migration
{
    public function up()
    {
        Schema::create('especialidades_funcionarios', function (Blueprint $table) {
            $table->foreignId('especialidade_id')->constrained()->onDelete('cascade');
            $table->foreignId('funcionario_id')->constrained()->onDelete('cascade');

            // Chave primária composta pelos dois IDs
            $table->primary(['especialidade_id', 'funcionario_id']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('especialidades_funcionarios');
    }
}
