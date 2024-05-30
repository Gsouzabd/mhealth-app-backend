<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_convenio');
            $table->string('numero');
            $table->string('tipo');
            $table->date('data');
            $table->string('status');
            $table->decimal('valor_total', 10, 2);
            $table->timestamps();

            $table->index('id_convenio');
            $table->index('numero');

            $table->foreign('id_convenio')->references('id')->on('convenios');
            $table->unique(['id_convenio', 'numero']); // Número é único para cada convênio
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotes');
    }
}
