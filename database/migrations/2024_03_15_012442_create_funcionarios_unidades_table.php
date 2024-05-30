<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosUnidadesTable extends Migration
{
    public function up()
    {
        Schema::create('funcionarios_unidades', function (Blueprint $table) {
            $table->foreignId('funcionario_id')->constrained()->onDelete('cascade');
            $table->foreignId('unidade_id')->constrained()->onDelete('cascade');
            $table->foreignId('turno_id')->constrained()->onDelete('cascade');

            // Chave primária composta pelos dois IDs
            $table->primary(['funcionario_id', 'unidade_id', 'turno_id']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('funcionarios_unidades');
    }
}
