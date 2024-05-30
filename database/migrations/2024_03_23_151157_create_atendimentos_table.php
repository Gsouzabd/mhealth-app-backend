<?php

use App\Enums\AtendimentoStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtendimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_marcacao');
            $table->date('data');
            $table->enum('status', array_column(AtendimentoStatus::cases(), 'name'))->nullable(); // ( m, ee, ea, r, f, d)
            $table->boolean('recorrente');
            $table->time('horario'); // Armazena apenas a hora
            $table->integer('duracao');
            $table->timestamps();

            $table->index('id_marcacao');
            $table->index('data');
            $table->index('status');

            $table->foreign('id_marcacao')->references('id')->on('marcacoes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atendimentos');
    }
}
