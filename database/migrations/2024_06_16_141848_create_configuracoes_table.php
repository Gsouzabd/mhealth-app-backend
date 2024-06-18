<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('configuracoes', function (Blueprint $table) {
                $table->id();
                $table->string('logo')->nullable();
                $table->string('nome_empresa'); // Not nullable
                $table->string('telefone')->nullable();
                $table->string('titulo')->nullable();
                $table->text('descricao')->nullable();
                $table->text('textoFooter')->nullable();
                $table->string('banner_app')->nullable();
                $table->string('banner_site')->nullable();
                $table->string('banner_site_mobile')->nullable();
                $table->boolean('segunda_sexta')->nullable();
                $table->string('segunda_sexta_horario_inicio')->nullable();
                $table->string('segunda_sexta_horario_fim')->nullable();
                $table->boolean('sabado_domingo')->nullable();
                $table->string('sabado_domingo_horario_inicio')->nullable();
                $table->string('sabado_domingo_horario_fim')->nullable();
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
        Schema::dropIfExists('configuracoes');
    }
}