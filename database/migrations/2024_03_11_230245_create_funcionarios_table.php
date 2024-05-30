<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            // Campos gerais de Usuários
            $table->id();
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('email')->unique();
            $table->date('data_nascimento');
            $table->char('sexo', 1);
            $table->string('foto')->nullable();
            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();
            $table->string('pais')->nullable();
            $table->timestamp('data_criacao')->useCurrent();

            // Campos específicos para Funcionário
            $table->string('password');
            $table->string('area')->nullable();
            $table->boolean('administrativo')->default(false);
            $table->boolean('especialista')->default(false);
            $table->string('especialidade')->nullable();
            $table->unsignedBigInteger('calendario_id')->nullable();
            $table->string('numConselho')->nullable();
            $table->string('ufConselho')->nullable();
            $table->integer('conselho')->nullable();
            $table->dateTime('dataUltimoAcesso')->nullable();
            $table->string('system')->nullable();
            $table->string('deviceToken')->nullable();
            $table->date('data_contratacao')->nullable();
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
        Schema::dropIfExists('funcionarios');
    }
}
