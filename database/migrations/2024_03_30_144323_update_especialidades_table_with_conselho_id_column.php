<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEspecialidadesTableWithConselhoIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Remove a coluna 'conselho' da tabela 'especialidades'
        Schema::table('especialidades', function (Blueprint $table) {
            $table->dropColumn('conselho');
        });

        // Adiciona a coluna 'conselho_id' à tabela 'especialidades'
        Schema::table('especialidades', function (Blueprint $table) {
            $table->unsignedBigInteger('conselho_id')->nullable()->after('descricao');
            $table->foreign('conselho_id')->references('id')->on('conselhos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Recria a coluna 'conselho' na tabela 'especialidades'
        Schema::table('especialidades', function (Blueprint $table) {
            $table->string('conselho')->after('descricao');
        });

        // Remove a coluna 'conselho_id' e a foreign key
        Schema::table('especialidades', function (Blueprint $table) {
            $table->dropForeign(['conselho_id']);
            $table->dropColumn('conselho_id');
        });
    }
}
