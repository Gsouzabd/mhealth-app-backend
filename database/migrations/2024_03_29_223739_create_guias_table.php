<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiasTable extends Migration
{
    public function up()
    {
        Schema::create('guias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lote')->nullable();
            $table->string('lote_numero')->nullable();

            $table->string('status');
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_convenio');
            $table->unsignedBigInteger('id_procedimento');
            $table->string('num_guia_prestador')->nullable();
            $table->string('num_guia_operadora')->nullable();
            $table->date('data');
            $table->integer('quantidade');
            $table->decimal('valor', 8, 2);
            $table->string('tabela')->nullable();
            $table->unsignedBigInteger('id_contratado_executante');
            $table->string('codigo_operadora_contratado')->nullable();
            $table->string('cnpj_contratado', 14)->nullable();
            $table->string('cnes_contratado')->nullable();
            $table->unsignedBigInteger('id_profissional_executante');
            $table->string('codigo_operadora_profissional')->nullable();
            $table->string('conselho_profissional')->nullable();
            $table->string('numero_conselho_profissional')->nullable();
            $table->char('uf_conselho_profissional', 2)->nullable();
            $table->string('cbo_s')->nullable();
            $table->string('tipo_consulta')->nullable();
            $table->string('indicador_acidente')->nullable();
            $table->string('cobertura_especial')->nullable();
            $table->string('atendimento_regime')->nullable();
            $table->text('observacao')->nullable();
            $table->timestamps();

            $table->index('lote_numero');
            $table->index('id_convenio');
            $table->index('status');

            $table->foreign('id_lote')->references('id')->on('lotes')->onDelete('set null');
            $table->foreign('lote_numero')->references('numero')->on('lotes')->onDelete('set null');

            $table->foreign('id_paciente')->references('id')->on('pacientes');
            $table->foreign('id_convenio')->references('id')->on('convenios');
            $table->foreign('id_procedimento')->references('id')->on('procedimentos');

            $table->foreign('id_contratado_executante')->references('id')->on('unidades');
            $table->foreign('id_profissional_executante')->references('id')->on('funcionarios');
        });
    }

    public function down()
    {
        Schema::dropIfExists('guias');
    }
}
