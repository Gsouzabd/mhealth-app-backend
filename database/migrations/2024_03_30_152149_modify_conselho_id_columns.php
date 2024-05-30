<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyConselhoIdColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Adiciona a coluna 'id_conselho' na tabela 'guias'
        Schema::table('guias', function (Blueprint $table) {
            $table->unsignedBigInteger('id_conselho')->nullable()->after('codigo_operadora_profissional');
            $table->foreign('id_conselho')->references('id')->on('conselhos')->onDelete('set null');
            $table->dropColumn('conselho_profissional');
        });

        // Adiciona a coluna 'id_conselho' na tabela 'funcionarios'
        Schema::table('funcionarios', function (Blueprint $table) {
            $table->unsignedBigInteger('id_conselho')->nullable()->after('conselho');
            $table->foreign('id_conselho')->references('id')->on('conselhos')->onDelete('set null');
            $table->dropColumn('conselho');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Desfaz as alterações na tabela 'funcionarios'
        Schema::table('funcionarios', function (Blueprint $table) {
            $table->string('conselho')->nullable()->after('id_conselho');
            $table->dropForeign(['id_conselho']);
            $table->dropColumn('id_conselho');
        });

        // Desfaz as alterações na tabela 'guias'
        Schema::table('guias', function (Blueprint $table) {
            $table->string('conselho')->nullable()->after('id_conselho');
            $table->dropForeign(['id_conselho']);
            $table->dropColumn('id_conselho');
        });

        // Renomeia a tabela 'conselhos' para 'especialidades_conselhos'
        Schema::rename('conselhos', 'especialidades_conselhos');
    }
}
